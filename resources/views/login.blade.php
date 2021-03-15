@extends('layouts.app')

@section('content')
    @php
        $time = explode(':', env('OPEN_TIME', "9:00"));
        if (sizeof($time) < 2) {
            $time[1] = '00'; 
        }
        $openTime = $time[0] . ':'. $time[1];
        $deliveryStart = $time[0]+1 . ':'. $time[1];

        $time = explode(':', env('CLOSE_TIME', "16:00"));
         if (sizeof($time) < 2) {
            $time[1] = '00'; 
        }
        if ($time[0] > 12) {
            $time[0] -= 12;
        }
        $closeTime = $time[0] . ':'. $time[1];
        $deliveryEnd = $time[0]+1 . ':'. $time[1];
    @endphp
    <div class="container">
            <div class="card">
                <div class="card-header">{{ __('Login') }}    
                    <h4>
                        {{__('messages.order',['startTime' => $openTime, 'endTime'=>$closeTime])}}
                    </h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label for="unit">{{__('Unit Number')}}:</label>
                            <input type="input" name="unit" value="{{old('unit')}}">
                            <label for="name">{{__('Last Name')}}:</label>
                            <input type="input" name="name" value="{{old('name')}}">
                            <label for="time">{{__('Requested Delivery Time')}} 
                                {{__('messages.delivery', [
                                    'startTime' => $deliveryStart,  'endTime'=>$deliveryEnd])}}<br> {{__('(Please allow about 30 minutes)')}}: </label>
                            <input type="text" name="time" value="{{old('time')}}">
                            <label for="location">{{__("Deliver to")}}:</label>
                            	<select name="location" required="required" id="location">
	                                {{-- <option value="Departamento">{{__("Apartment")}}</option>
	                                <option value="Alberca">{{__("Pool Deck")}}</option> --}}
                                    <option value="Palapa" selected="selected">{{__("Palapa")}}</option>
	                                <option value="Pick up" >{{__("Pick up")}}</option>                                    
                                </select>
                        </div>
                        <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                        </div>
                    </form>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif                    
                </div>
            </div>
        </div>
@endsection
