<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Order;

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
}
