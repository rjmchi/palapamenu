<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUnit;
use App\Order;

class RegisterController extends Controller
{
    public function index() {
        return (view('auth.login'));
    }

    public function register(RegisterUnit $request) {
        $validated = $request->validated();

        session(['unit' => $request->input('unit')]);
        session(['name' => $request->input('name')]);
        $order = new Order;
        $order->apt = session('unit');
        $order->name = session('name');
        $order->delivery_time = $request->input('time');
        $order->location = $request->input('location');
        $order->save();

        session(['orderid'=> $order->id]);

        return redirect('/');
    }
}
