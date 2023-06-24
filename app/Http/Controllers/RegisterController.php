<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterUnit;
use App\Models\Order;
use Carbon\Carbon;

class RegisterController extends Controller
{
    public function __construct()
    {
        // $this->middleware('register',['except'=>['fullmenu']]);
    }

    public function index()
    {
        // $openTime = Carbon::create(env('OPEN_TIME', "9:00"), 'America/Mexico_City');
        $openTime = Carbon::create(env('OPEN_TIME', "9:00"), '-6:00');

        // $closeTime = Carbon::create(env('CLOSE_TIME', "15:00"), 'America/Mexico_City');
        $closeTime = Carbon::create(env('CLOSE_TIME', "15:00"), '-6:00');
        // $deliveryStart = Carbon::now('America/Mexico_City');
        $deliveryStart = Carbon::now('-6:00');

        if ($deliveryStart < $openTime) {
            $deliveryStart = $openTime;
        }
        $deliveryStart->second = 0;

        $deliveryStart->add(29, 'minutes');

        $m = $deliveryStart->minute;
        $v = 15 - $m % 15;
        $deliveryStart->add($v, 'minutes');

        // $deliveryEnd = Carbon::create($closeTime->toDateTimeString(), 'America/Mexico_City');
        $deliveryEnd = Carbon::create($closeTime->toDateTimeString(), '-6:00');
        $deliveryEnd->add(30, 'minutes');

        $data['openTime'] = $openTime->format('g:i A');
        $data['closeTime'] = $closeTime->format('g:i A');
        $data['deliveryStart'] = $deliveryStart->format('g:i A');
        $data['deliveryEnd'] = $deliveryEnd->format('g:i A');

        $deliveryTimes = array();
        while ($deliveryStart <= $deliveryEnd) {
            $deliveryTimes[] = $deliveryStart->format('g:i A');
            $deliveryStart->add(15, "minutes");
        }
        $data['deliveryTimes'] = $deliveryTimes;
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
    }}
