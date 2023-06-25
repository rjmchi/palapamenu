<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Menu;
use App\Models\Item;
use App\Models\Option;
use App\Models\Choice;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use App\Mail\Order as MailOrder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('register',['except'=>['fullmenu']]);
    }

    public function index() {
        $data['menus'] = Menu::orderBy('sort_order')->get();
        $data['order'] = Order::orderBy('created_at', 'desc')->where('apt', session('unit'))->where('sent', false)->get()->first();

        if (!$data['order']) {
            $order = new Order;
            $order->apt = session('unit');
            $order->name = session('name');
            $order->location = session('location');
            $order->save();
            $data['order']= $order;
            session(['orderid'=> $order->id]);
        }
        return view('home')->with($data);
    }

    public function processOrder(Request $request) {
        $rules['qty'] = 'required | integer | gt:0';
        if (isset($request->max)) {
            $rules['selection'] = 'max:'.$request->max;
        }
        $validator = Validator::make($request->all(),
        $rules,
        ['qty.required' => __('The quantity field is required'),
            'qty.integer' => __('The quantity must be a whole number'),
            'qty.gt' => __('The quantity must be greater than zero'),
            'selection.max' => __('Too many selections'),])->validate();

        $item = Item::find($request->input('item'));
        $orderitem = new OrderItem;
        $orderitem->order_id = session('orderid');

        $orderitem->quantity = $request->input('qty');
        $orderitem->item_id  = $request->input('item');
        $orderitem->price = $orderitem->quantity * $item->price;

        if ($request->input('option')) {
            $orderitem->option_id = $request->input('option');
            $option = Option::find($request->input('option'));
            $orderitem->price = $orderitem->quantity * $option->price;
        }
        if ($request->input('choice')){
            $orderitem->choice_id = $request->input('choice');
        }

        if ($request->input('special')){
            $orderitem->special = $request->input('special');
        }
        $orderitem->save();
        if ($request->input('selection')){
            foreach ($request->input('selection') as $s){
                $orderitem->selections()->attach($s);
            }
        }
        return redirect('/');
    }

    public function addItemToOrder(Request $request) {
        $segments= $request->segments();
        $item = $segments[1];

        $option = 0;
        $choice = 0;

        $data['item'] = Item::find($item);

        if (isset($segments[2])){
            $option = $segments[2];
            $data['option']= Option::find($option);
        } else {
            $data['option']='';
        }
        if (isset($segments[3])){
            $choice = $segments[3];
            $data['choice']= Choice::find($choice);
        } else {
            $data['choice'] = '';
        }

        return view('orderitem')->with($data);
    }

    public function sendOrder() {
        $order = Order::find(session('orderid'));

        $order->sent = true;
        $order->save();
        $order->subtotal = 0;
        $order->total = 0;
        $order->serviceCharge = 0;
        $now = Carbon::now('-6:00');
        // $now = Carbon::now('America/Mexico_City');
        $order->date = $now->format('d M Y h:i a');
        foreach ($order->orderItems as $item)  {
            $order->subtotal += $item->price;
        }
        $order->serviceCharge = round($order->subtotal * .15);
        $order->total = $order->subtotal + $order->serviceCharge;
        Mail::to('lospalmarespalapa@gmail.com')->send(new MailOrder($order));
        session()->flash("message", __("Your order has been sent"));
        session()->forget('unit');
        session()->forget('name');
        return redirect('/register');
    }

    public function cancelOrder(Order $order) {
        $order->delete();

        session()->flash("message", __("Your order has been canceled"));
        return redirect('/register');
    }

    public function removeItemFromOrder(OrderItem $item) {
        $item->delete();
        return redirect('/');
    }
}
