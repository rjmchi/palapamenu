@extends('layouts.app')

@section('content')
    
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
                                    'startTime' => $deliveryStart,  'endTime'=>$deliveryEnd])}}<br> {{__('(Please allow 30 minutes)')}}: </label>
                            <input type="text" name="time" value="{{old('time')}}" placeholder="{{$deliveryStart}}">
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
