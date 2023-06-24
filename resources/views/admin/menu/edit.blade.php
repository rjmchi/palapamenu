@extends('layouts.admin')

@section('content')
    <form class="editform" action="{{route('menu.update',$menu->id)}}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="en_name"  value="{{$menu->translate('en')->name}}">
        <input type="text" name="es_name" value="{{$menu->translate('es')->name}}">
        <input type="text" name="sort_order" value="{{$menu->sort_order}}">
        <input type="hidden" name="web" value="true">
        <button class="btn btn-primary" type="submit">Update</button>
    </form>

    <h3>Categories</h3>
        @foreach ($menu->categories as $cat)
        <div class="sub-level">
            <a href="{{route('category.edit', $cat->id)}}">
                <p><span>English Name: </span>{{$cat->translate('en')->name}}</p>
                <p><span>Spanish Name: </span>{{$cat->translate('es')->name}}</p>
                <p><span>English Description: </span>{{$cat->translate('en')->description}}</p>
                <p><span>Spanish Description: </span>{{$cat->translate('es')->description}}</p>
                <p><span>Sort Order: </span>{{$cat->sort_order}}</p>
            </a>
            <form method="post" action="{{route('category.destroy', $cat->id)}}">
                @csrf
                @method('delete')
                <input type="hidden" name="web" value="true">
                <input type="hidden" name="id" value="{{$cat->id}}">
                <input type="hidden" name="menu_id" value="{{$menu->id}}">

                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
        @endforeach

    <div class="newform">
        <h2>New Category</h2>
        <form action="{{route('category.store')}}" method="POST">
            @csrf
            <input type="hidden" name="web" value="true">
            <input type="hidden" name="menu_id" value="{{$menu->id}}">
            <div class="input-group">
                <label for="en_name">English Name</label>
                <input type="text" name="en_name" class="form-control">
                <label for="es_name">Spanish Name</label>
                <input type="text" name="es_name" class="form-control">
            </div>
            <div class="input-group">
                <label for="en_description">English Description</label>
                <input type="text" name="en_description" class="form-control">
                <label for="es_description">Spanish Description</label>
                <input type="text" name="es_description" class="form-control">
            </div>
            <div class="input-group col-2">
                <label for="sort_order">Sort order:</label>
                <input type="text" name="sort_order" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Add Category</button>
        </form>
    </div>
@endsection