@extends('layouts.app')

@section('content')
<div class="container">
    <form method = "post" action="/order" class="order">
        @csrf
        <input type="hidden" name="item" value="{{$item->id}}">
        <input type="hidden" name="option" value="{{ $option->id ?? '' }}">
        <h3>{{$option ? $option->name : $item->name}}</h3>
        <p>{{__('Quantity')}}: <input name="qty" type="text" value="1" class="qty w-16"></p>
        <div class="select mt-4">
            @if ($item->selections)
                @if($item->no_of_choices)
                    <input type="hidden" name="max" value="{{$item->no_of_choices}}">
                @endif
                @foreach ($item->selections as $selection)
                <div class="input-group pl-2 inline">
                    <input class="mr-2" type="checkbox" name="selection[]" value="{{$selection->id}}">{{$selection->name}}
                </div>
                @endforeach
            @endif
        </div>
        <div class="choices mb-5 ml-3 text-left">
            @php $checked = "checked=checked" @endphp
            @foreach($item->choices as $choice)
                <label for="{{$choice->name}}" class="block">
                    <input class="mr-2" type="radio" id="{{$choice->name}}" name="choice"  {{$checked}} value="{{$choice->id}}" />
                {{$choice->name}}</label>
                @php $checked = '' @endphp
            @endforeach
        </div>
    <p>
    <label for="special">{{__('Special Instructions')}}</label>
    <textarea name="special" class="form-control w-full"></textarea>
    </p>
    <p>
        <button type="submit" class="btn btn-primary block w-full mb-2 md:inline md:w-auto">{{__('Add to Order')}}</button>
        <a href="/" class="btn btn-danger block md:inline">{{__("Cancel")}}</a>
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