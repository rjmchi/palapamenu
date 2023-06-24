@extends('layouts.admin')
@section('content')
    <h3>Menus</h3>
    @foreach($menus as $menu)
        <div class="top-level">
            <a href="{{route('menu.edit',$menu->id)}}">
                <p>{{$menu->translate('es')->name}}</p>
                <p>{{$menu->translate('en')->name}}</p>
            </a>
            <form action={{route('menu.destroy', $menu->id)}}  method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete</button>
                <input type="hidden" name="web" value="true">
            </form>
        </div>

    @endforeach
    <div class="newform">
        <h2>New Menu</h2>
        <form action="{{route('menu.store')}}" method="POST">
             @csrf
            <input type="hidden" name="web" value="true">
            <div class="input-group">
                <label for="en_name">English Name:</label>
                <input type="text" name="en_name" placeholder="English Name" class="form-control">
                <label for="es_name">Spanish Name:</label>
                <input type="text" name="es_name" placeholder="Spanish Name" class="form-control">
                <label for="sort_order">Sort Order:</label>
                <input type="text" name="sort_order" value="10" class="form-control">
            </div>
            <button class="btn btn-primary" type="submit">Add</button>
        </form>
    </div>
@endsection
