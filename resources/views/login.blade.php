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
                                    'startTime' => $deliveryStart,  'endTime'=>$deliveryEnd])}}<br> ({{__('Please allow at least 30 minutes')}}): </label>
                            <input type="text" name="time" value="{{(old('time')) ? old('time'): $deliveryStart}}" placeholder="{{$deliveryStart}}">

                            <div class="form-check">
                            <label class="form-check-label"> 
                                <input class="form-check-input"  type="radio" name="location" value="Palapa" id="location1" {{ (old('location') == 'Palapa' || old('location')=='') ? 'checked' : '' }}>
                                    {{__('I will eat at the Palapa')}} &mdash; {{__('use glass dishes')}}
                                </label>
                                
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="location" value="Para llevar" id="location2" {{ (old('location') == 'Para llevar') ? 'checked' : '' }}>  
		                            {{__('I will pick up from the Palapa')}} &mdash; {{__('use paper plates')}}
                                </label>   
                            </div>                                 
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
