@extends('layouts.admin')

@section('content')
<h2>Edit Option</h2>
        <form class="editform" action="{{route('admin.optionupdate', $option->id)}}" method="POST">
            @csrf
            @method('put')
            <input type="hidden" name="web" value="true">
            <input type="hidden" name="item_id" value="{{$option->item_id}}">
            <div class="input-group">
                <label for="en_name">English Name</label>
                <input type="text" name="en_name" class="form-control" value="{{$option->translate('en')->name}}">
                <label for="es_name">Spanish Name</label>
                <input type="text" name="es_name" class="form-control" value="{{$option->translate('es')->name}}">
            </div>                
            <div class="input-group col-8">
                <label for="price">Price:</label>
                <input type="text" name="price" class="form-control" value="{{$option->price}}">                
                <label for="sort_order">Sort order:</label>
                <input type="text" name="sort_order" class="form-control" value="{{$option->sort_order}}">
                <label for="instructions">Instructions</label>
                <input type="checkbox" name="instructions" checked value="{{$option->instructions}}">
            </div>
            <button type="submit" class="btn btn-primary">Update Option</button>
        </form>@endsection