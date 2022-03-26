@extends('layouts.admin')

@section('content')
<h2>Edit Selection</h2>
        <form class="editform" action="{{route('admin.selectionupdate', $selection->id)}}" method="POST">
            @csrf
            @method('put')
            <input type="hidden" name="web" value="true">
            <input type="hidden" name="item_id" value="{{$selection->item_id}}">
            <div class="input-group">
                <label for="en_name">English Name</label>
                <input type="text" name="en_name" class="form-control" value="{{$selection->translate('en')->name}}">
                <label for="es_name">Spanish Name</label>
                <input type="text" name="es_name" class="form-control" value="{{$selection->translate('es')->name}}">
            </div>
            
            <button type="submit" class="btn btn-primary">Update Selection</button>
        </form>
@endsection