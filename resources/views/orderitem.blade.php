@extends('layouts.app')

@section('content')
<div class="container">
    <form method = "post" action="/order" class="order">
        @csrf
        <input type="hidden" name="item" value="{{$item->id}}">
        <input type="hidden" name="option" value="{{ $option->id ?? '' }}">
        <h3>{{$option ? $option->name : $item->name}}</h3>
        <p>{{__('Quantity')}}: <input name="qty" type="input" value="1" class="qty"></p>
        <div class="choices">
            @foreach($item->choices as $choice)
                <label for="{{$choice->name}}"><input type="radio" id="{{$choice->name}}" name="choice" value="{{$choice->id}}"/>
                {{$choice->name}}</label>
            @endforeach
        </div>
    <p>
    <label for="special">{{__('Special Instructions')}}</label>
    <textarea name="special" class="form-control"></textarea>
    </p>
    <p>
        <button type="submit" class="btn btn-primary">{{__('Add to Order')}}</button>
        <a href="/" class="btn btn-danger">{{__("Cancel")}}</a>
    </p>
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
@endsection