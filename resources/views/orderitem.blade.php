@extends('layouts.app')

@section('content')
<div class="container">
    <form method = "post" action="/order" class="order">
        @csrf
        <input type="hidden" name="item" value="{{$item->name}}">
        <input type="hidden" name="option" value="{{ $option->name ?? '' }}">
        <h3>{{$option ? $option->name : $item->name}}</h3>
        <p>{{__('Quantity')}}: <input name="qty" type="input" value="1" class="qty"></p>
<div class="choices">
    @foreach($item->choices as $choice)
        <label for="{{$choice->name}}"><input type="radio" id="{{$choice->name}}" name="choice" value="{{$choice->name}}"/>
        {{$choice->name}}</label>
    @endforeach
</div>
    <p>
    <label for="special">{{__('Special Instructions')}}</label>
    <textarea name="special" class="form-control"></textarea>
    </p>
    <p><button type="submit" class="btn btn-primary">{{__('Add to Order')}}</button></p>
    </form>
</div>
@endsection