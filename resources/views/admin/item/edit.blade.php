@extends('layouts.admin')

@section('content')

<form class="editform" action="{{route('item.update', $item->id)}}" method="POST">
    @csrf
    @method('put')
    <input type="hidden" name="web" value="true">
    <div class="input-group">
        <label for="en_name">English Name: </label>
        <input type="text" name="en_name" value="{{$item->translate('en')->name}}" class="form-control">
        <label for="es_name">Spanish Name: </label>
        <input type="text" name="es_name" value="{{$item->translate('es')->name}}" class="form-control">
    </div>
    <div class="input-group">
        <label for="en_description">English Description: </label>
        <input type="text" name="en_description" value="{{$item->translate('en')->description}}" class="form-control">
    </div>
    <div class="input-group">
        <label for="es_description">Spanish Description: </label>
        <input type="text" name="es_description" value="{{$item->translate('es')->description}}" class="form-control">
    </div>
    <div class="input-group col-5">
        <label for="price">Price: </label>
        <input type="text" name="price" value="{{$item->price}}" class="form-control">
        <label for="sort_order">Sort order: </label>
        <input type="text" name="sort_order" value="{{$item->sort_order}}" class="form-control">
        <button class="btn btn-primary">Update Item</button>
    </div>
</form>

    <div class="m-6">
        <h3 class="ml-2">Choices</h3>
        @foreach ($item->choices as $choice)
        <div class="sub-level">
                <a href="{{route('choice.edit', $choice->id)}}">
                    <p><span>English Name: </span>{{$choice->translate('en')->name}}</p>
                    <p><span>Spanish Name: </span>{{$choice->translate('es')->name}}</p>
                    <p><span>Sort Order: </span>{{$choice->sort_order}}</p>
                </a>
            <form method="post" action="{{route('choice.destroy', $choice->id)}}">
                @csrf
                @method('delete')
                <input type="hidden" name="web" value="true">
                <input type="hidden" name="id" value="{{$choice->id}}">
                <input type="hidden" name="item_id" value="{{$choice->item_id}}">

                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
        @endforeach

        <div class="newform">
            <h2>New Choice</h2>
                <form action="{{route('choice.store')}}" method="POST">
                    @csrf
                    <input type="hidden" name="web" value="true">
                    <input type="hidden" name="item_id" value="{{$item->id}}">
                    <div class="input-group">
                        <label for="en_name">English Name</label>
                        <input type="text" name="en_name" class="form-control">
                        <label for="es_name">Spanish Name</label>
                        <input type="text" name="es_name" class="form-control">
                    </div>
                    <div class="input-group col-4">
                        <label for="sort_order">Sort order:</label>
                        <input type="text" name="sort_order" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Choice</button>
                </form>
        </div>
    </div>
    <div class="m-6">
        <h3 class="ml-2">Options</h3>
        @foreach ($item->options as $option)
        <div class="sub-level">
                <a href="{{route('option.edit', $option->id)}}">
                    <p><span>English Name: </span>{{$option->translate('en')->name}}</p>
                    <p><span>Spanish Name: </span>{{$option->translate('es')->name}}</p>
                    <p><span>Sort Order: </span>{{$option->sort_order}}</p>
                    <p><span>Price: </span>{{$option->price}}</p>
                </a>
            <form method="post" action="{{route('option.destroy', $option->id)}}">
                @csrf
                @method('delete')
                <input type="hidden" name="web" value="true">
                <input type="hidden" name="id" value="{{$option->id}}">
                <input type="hidden" name="item_id" value="{{$item->id}}">

                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
        @endforeach

    <div class="newform">
        <h2>New Option</h2>
            <form action="{{route('option.store')}}" method="POST">
                @csrf
                <input type="hidden" name="web" value="true">
                <input type="hidden" name="item_id" value="{{$item->id}}">
                <div class="input-group">
                    <label for="en_name">English Name</label>
                    <input type="text" name="en_name" class="form-control">
                    <label for="es_name">Spanish Name</label>
                    <input type="text" name="es_name" class="form-control">
                </div>
                <div class="input-group col-6">
                    <label for="price">Price:</label>
                    <input type="text" name="price" class="form-control">
                    <label for="sort_order">Sort order:</label>
                    <input type="text" name="sort_order" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Add Option</button>
            </form>
        </div>
    </div>

@endsection