@extends('layouts.app')

@section('content')

    <div class="w-full">
            <div class="mx-auto card">
                <div class="card-header">{{ __('Login') }}
                    <h4 class="text-xl font-semibold">
                        {{__('messages.order',['startTime' => $openTime, 'endTime'=>$closeTime])}}
                    </h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="text-center form-group">
                            <label for="unit">{{__('Unit Number')}}:</label>
                            <input type="text" name="unit" value="{{old('unit')}}">
                            <label for="name">{{__('Last Name')}}:</label>
                            <input type="text" name="name" value="{{old('name')}}">
                            <label for="time">{{__('Requested Delivery Time')}}
                                {{__('messages.delivery', [
                                    'startTime' => $deliveryStart,  'endTime'=>$deliveryEnd])}}<br> ({{__('Please allow at least 30 minutes')}}): </label>
                                    <select name="time" id="time">
                                    @foreach($deliveryTimes as $deliveryTime)
                                    <option value="{{$deliveryTime}}">{{$deliveryTime}}</option>
                                    @endforeach
                                    </select>

                            <div class="form-check">
                            {{-- <label class="form-check-label">
                                <input class="form-check-input"  type="radio" name="location" value="Palapa" id="location1" {{ (old('location') == 'Palapa' || old('location')=='') ? 'checked' : '' }}>
                                    {{__('I will eat at the Palapa')}} &mdash; {{__('use glass dishes')}}
                                </label> --}}

                                {{-- <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="location" value="Para llevar" id="location2" {{ (old('location') == 'Para llevar') ? 'checked' : '' }}>
		                            {{__('I will pick up from the Palapa')}} &mdash; {{__('use paper plates')}}
                                </label> --}}

                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="location" value="Para llevar" id="location2" checked>
		                            {{__('I will pick up from the Palapa')}} &mdash; {{__('use paper plates')}}
                                </label>
                            </div>
                        </div>
                        <div class="text-center form-group">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                        </div>
                    </form>

@if ($errors->any())
    <div class="text-center alert alert-danger">
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