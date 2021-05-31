<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUnit;
use App\Order;
use Carbon\Carbon;

class RegisterController extends Controller
{
    public function index()
    {
        $openTime = Carbon::today();
        $time = explode(':', env('OPEN_TIME', "9:00"));
        $openTime->hour = $time[0];
        if (sizeof($time) == 2) {
            $openTime->minute = $time[1];
        }
        $closeTime = Carbon::today();
        $time = explode(':', env('CLOSE_TIME', "16:00"));
        if ($time[0] < 12) {
            $time[0] += 12;
        }
        $closeTime->hour = $time[0];
        if (sizeof($time) == 2) {
            $closeTime->minute = $time[1];
        }

        // $deliveryStart = Carbon::create($openTime->toDateTimeString());
        $deliveryStart = Carbon::now('America/Mexico_City');
        $deliveryStart->add(31, 'minutes');

        $deliveryEnd = Carbon::create($closeTime->toDateTimeString());
        $deliveryEnd->add(30, 'minutes');

        $data['openTime'] = $openTime->format('g:i A');
        $data['closeTime'] = $closeTime->format('g:i A');
        $data['deliveryStart'] = $deliveryStart->format('g:i A');
        $data['deliveryEnd'] = $deliveryEnd->format('g:i A');
        return (view('login')->with($data));
    }

    public function register(RegisterUnit $request)
    {
        $validated = $request->validated();

        session(['unit' => $request->input('unit')]);
        session(['name' => $request->input('name')]);
        session(['location' => $request->input('location')]);
        $order = new Order;
        $order->apt = session('unit');
        $order->name = session('name');
        $order->delivery_time = $request->input('time');
        $order->location = $request->input('location');
        $order->save();

        session(['orderid' => $order->id]);

        return redirect('/');
    }
}
