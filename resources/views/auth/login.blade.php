@extends('layouts.app')

@section('content')
<div class="container">
            <div class="card">
                <div class="card-header">{{ __('Login') }}    
                    <h4>{{__('Orders accepted between 9:00 am and 3:00 pm')}}</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label for="unit">{{__('Unit Number')}}:</label>
                            <input type="input" name="unit" value="{{old('unit')}}">
                            <label for="name">{{__('Last Name')}}:</label>
                            <input type="input" name="name" value="{{old('name')}}">
                            <label for="time">{{__('Requested Delivery Time')}} {{__("10:00 AM-4:30 PM")}}<br> {{__('(Please allow about 1 hour)')}}: </label>
                            <input type="text" name="time" value="{{old('time')}}">
                            <label for="location">{{__("Deliver to")}}:</label>
                            	<select name="location" required="required" id="location">
	                                <option value="Departamento">{{__("Apartment")}}</option>
	                                <option value="Alberca">{{__("Pool Deck")}}</option>
	                                <option value="Palapa">{{__("Palapa")}}</option>
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
