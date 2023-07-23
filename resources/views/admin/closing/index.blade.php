@extends('layouts.admin')

@section('content')

    <div class="newform">
        <h2>Close Palapa</h2>
        @if (isset($edit))
        <form action="{{route('closing.update', $edit->id)}}" method="POST">
            @method('put')
        @else
            <form action="{{route('closing.store')}}" method="POST">
        @endif
            @csrf
            <input type="hidden" name="web" value="true">
            <input type="date" name="date" value="{{isset($edit) ? $edit->close_on : ''}}">
            <div class="w-full flex">
                <label for="en_title" class="basis-2/12">English Title: </label>
                <input type="text" name="en_title" class="basis-9/12" value="{{isset($edit) ? $edit->translate('en')->title : ''}}">
            </div>
            <div class="w-full flex">
                <label for="es_title" class="w-2/12">Spanish Title: </label>
                <input type="text" name="es_title" class="w-9/12" value="{{isset($edit) ? $edit->translate('es')->title : ''}}">
            </div>
            <div class="w-full flex">
                <label for="en_message" class="w-2/12">English Message: </label>
                <textarea name="en_message" class="w-9/12">{{isset($edit) ? $edit->translate('en')->message : ''}}</textarea>
            </div>
            <div class="w-full flex">
                <label for="es_message" class="w-2/12">Spanish Message: </label>
                <textarea name="es_message" class="w-9/12">{{isset($edit) ? $edit->translate('es')->message : ''}}</textarea>
            </div>
            @if (isset($edit))
                <button type="submit" class="btn btn-primary">Update</button>
            @else
                <button type="submit" class="btn btn-primary">Submit</button>
            @endif
        </form>
    </div>

<div class="ml-3 mt-4">
    <h3>Closings</h3>

    @foreach ($closings as $closing)
    <div class="flex flex-nowrap items-center text-neutral-900 font-medium bg-neutral-200 mx-2 p-1 basis-full border rounded border-slate-400 hover:bg-neutral-300">
        <span class="basis-3/4 border-neutral-400 border-2 rounded p-2">
            <p class="text-xl m-2"> {{ \Carbon\Carbon::parse( $closing->close_on)->format('D M j, Y') }}</p>
            <div class="">
                <p class="m-2 basis-full"><span class="font-bold">English Title:</span> {{$closing->translate('en')->title}}</p>
                <p class="m-2"><span class="font-bold">Spanish Title:</span> {{$closing->translate('es')->title}}</p>
                <p class="m-2"><span class="font-bold">English Message:</span> {{$closing->translate('en')->message}}</p>
                <p class="m-2"><span class="font-bold">Spanish Message:</span> {{$closing->translate('es')->message}}</p>
            </div>
        </span>
        <span class="ml-5">
            <a class="btn btn-primary" href="{{route('closing.edit', $closing->id)}}">Edit</a>

            <form action="{{route('closing.delete', $closing->id)}}" method="post">
                @csrf
                @method('delete')
                <button class="btn btn-danger">Delete</button>
            </form>
        </span>
    </div>
    @endforeach
</div>
@endsection