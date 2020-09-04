@extends('layouts.app')

@section('content')
<div class="container">
    <form method = "post" action="/order" class="order">
        @csrf
        <input type="hidden" name="item" value="{{$item->id}}">
        <input type="hidden" name="option" value="{{ $option->id ?? '' }}">
        <h3>{{$option ? $option->name : $item->name}}</h3>
        <p>{{__('Quantity')}}: <input name="qty" type="input" value="1" class="qty"></p>
        <div class="select">
            @if ($item->selections)
                @if($item->no_of_choices)
                    <input type="hidden" name="max" value="{{$item->no_of_choices}}">
                @endif            
                @foreach ($item->selections as $selection)
                <div class="input-group">
                    <input type="checkbox" name="selection[]" value="{{$selection->id}}">{{$selection->name}}
                </div>
                @endforeach
            @endif
        </div>
        <div class="choices">
            @php $checked = "checked=checked" @endphp
            @foreach($item->choices as $choice)
                <label for="{{$choice->name}}"><input type="radio" id="{{$choice->name}}" name="choice"  {{$checked}} value="{{$choice->id}}" />
                {{$choice->name}}</label>
                @php $checked = '' @endphp
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