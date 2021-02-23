@extends('layouts.admin')

@section('content')
<h2>Edit Choice</h2>
        <form class="editform" action="{{route('admin.choiceupdate', $choice->id)}}" method="POST">
            @csrf
            @method('put')
            <input type="hidden" name="web" value="true">
            <input type="hidden" name="item_id" value="{{$choice->item_id}}">
            <div class="input-group">
                <label for="en_name">English Name</label>
                <input type="text" name="en_name" class="form-control" value="{{$choice->translate('en')->name}}">
                <label for="es_name">Spanish Name</label>
                <input type="text" name="es_name" class="form-control" value="{{$choice->translate('es')->name}}">
            </div>
            <div class="input-group col-6">
                <label for="sort_order">Sort order:</label>
                <input type="text" name="sort_order" class="form-control" value="{{$choice->sort_order}}">
                <label for="instructions">Instructions</label>
                <input type="checkbox" name="instructions" checked value="{{$choice->instructions}}">
            </div>
            <button type="submit" class="btn btn-primary">Update Choice</button>
        </form>@endsection