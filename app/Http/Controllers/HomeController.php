<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Item;
use App\Order;
use App\OrderItem;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('register');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['menus'] = Menu::orderBy('sort_order')->get();
        $data['order'] = Order::orderBy('created_at', 'desc')->where('apt', session('unit'))->where('sent', false)->get()->first();
        if (!$data['order']) {
            $order = new Order;
            $order->apt = session('unit');
            $order->name = session('name');
            $order->save();
            $data['order']= $order;
            session(['orderid'=> $order->id]);
        }        
        return view('home')->with($data);
    }

    public function processOrder(Request $request) {
        $orderitem = new OrderItem;
        $orderitem->order_id = session('orderid');

        $orderitem->quantity = $request->input('qty');
        $orderitem->item  = $request->input('item');

        if ($request->input('option')) {
            $orderitem->item = $request->input('option');
        }
        if ($request->input('choice')){
            $orderitem->choice = $request->input('choice');
        }
        if ($request->input('special')){
            $orderitem->special = $request->input('special');
        }
        $orderitem->save();
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
        \Mail::to('rjmchi13@gmail.com')->send(new MailOrder($order));
        session()->flash("message", __("Your order has been sent"));
        return redirect('/');
    }

    public function cancelOrder($id) {
        $order = new Order;
        $order->find($id);
        $order->delete();

        session()->forget('unit');
        session()->forget('name');
        session()->flash("message", __("Your order has been canceled"));
        return redirect('/');
    }    
}
