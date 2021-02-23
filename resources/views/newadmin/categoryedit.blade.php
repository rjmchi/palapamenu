@extends('layouts.admin')

@section('content')
    <form class="editform" action="{{route('admin.categoryupdate', $category->id)}}" method="POST">
        @csrf
        @method('put')
        <input type="hidden" name="web" value="true">
        <input type="hidden" name="menu_id" value="{{$category->menu_id}}">
        <div class="input-group">
            <label for="en_name">English Name: </label>
            <input type="text" name="en_name" value="{{$category->translate('en')->name}}" class="form-control">    
            <label for="es_name">Spanish Name: </label>
            <input type="text" name="es_name" value="{{$category->translate('es')->name}}" class="form-control">
        </div>
        <div class="input-group">
            <label for="en_description">English Description: </label>
            <input type="text" name="en_description" value="{{$category->translate('en')->description}}" class="form-control"> 
        </div>
        <div class="input-group">
            <label for="es_description">Spanish Description: </label>
            <input type="text" name="es_description" value="{{$category->translate('es')->description}}" class="form-control"> 
        </div>
        <div class="input-group col-4">
            <label for="sort_order">Sort order: </label>
            <input type="text" name="sort_order" value="{{$category->sort_order}}" class="form-control"> 
        </div>
        <div class="input-group">
            <button class="btn btn-primary" type="submit">Update Category</button>
        </div>
    </form>

    <div class="top-level">
        <h3>Items</h3>
        @foreach ($category->items as $item)
        <div class="sub-level">
            <div class="content">
                <a href="{{route('admin.itemedit', $item->id)}}">
                    <p><span>English Name: </span>{{$item->translate('en')->name}}</p>
                    <p><span>Spanish Name: </span>{{$item->translate('es')->name}}</p>
                    <p><span>English Description:</span>{{$item->translate('en')->description}}</p>
                    <p><span>Spanish Description: </span>{{$item->translate('es')->description}}</p>
                    <p><span>Price: </span>{{$item->price}}</p>
                    <p><span>Sort Order: </span>{{$item->sort_order}}</p>
                </a>
            </div>
            <form method="post" action="{{route('admin.itemdelete', $item->id)}}">
                @csrf
                @method('delete')
                <input type="hidden" name="web" value="true">
                <input type="hidden" name="id" value="{{$item->id}}">
                <input type="hidden" name="category_id" value="{{$category->id}}">

                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div> 
        @endforeach
    </div>

    <div class="newform">
        <h2>New Item</h2>
        <form action="{{route('admin.itemstore')}}" method="POST">
            @csrf
            <input type="hidden" name="web" value="true">
            <input type="hidden" name="category_id" value="{{$category->id}}">
            <div class="input-group">
                <label for="en_name">English Name</label>
                <input type="text" name="en_name" class="form-control">
                <label for="es_name">Spanish Name</label>
                <input type="text" name="es_name" class="form-control">
            </div>
            <div class="input-group">
                <label for="en_description">English Description</label>
                <input type="text" name="en_description" class="form-control">
            </div>
            <div class="input-group">
                <label for="es_description">Spanish Description</label>
                <input type="text" name="es_description" class="form-control">
            </div>
            <div class="input-group col-4">                                
                <label for="price">Price: </label>
                <input type="text" name=price class="form-control">
                <label for="sort_order">Sort order:</label>
                <input type="text" name="sort_order" class="form-control">
            </div>                
            <button type="submit" class="btn btn-primary">Add Item</button>
        </form>
    </div>
@endsection