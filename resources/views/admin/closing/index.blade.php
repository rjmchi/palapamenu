@extends('layouts.admin')

@section('content')

    <div class="newform">
        <h2>Close Palapa</h2>
        <form action="{{route('closing.store')}}" method="POST">
            @csrf
            <input type="hidden" name="web" value="true">
            <input type="date" name="date">
            <div class="w-full flex">
                <label for="en_title" class="basis-2/12">English Title: </label>
                <input type="text" name="en_title" class="basis-9/12">
            </div>
            <div class="w-full flex">
                <label for="es_title" class="w-2/12">Spanish Title: </label>
                <input type="text" name="es_title" class="w-9/12">
            </div>
            <div class="w-full flex">
                <label for="en_message" class="w-2/12">English Message: </label>
                <textarea name="en_message" class="w-9/12"></textarea>
            </div>
            <div class="w-full flex">
                <label for="es_message" class="w-2/12">Spanish Message: </label>
                <textarea name="es_message" class="w-9/12"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

<div class="ml-3 mt-4">
    <h3>Closings</h3>

    @foreach ($closings as $closing)
    <div class="sub-level">
        <span class="basis-1/2 border-neutral-300 border-2">
            <p class="text-xl"> {{ \Carbon\Carbon::parse( $closing->close_on)->format('D M j, Y') }}</p>
            <p><span>English Title:</span> {{$closing->translate('en')->title}}</p>
            <p><span>Spanish Title:</span> {{$closing->translate('es')->title}}</p>
            <p><span>English Message:</span> {{$closing->translate('en')->message}}</p>
            <p><span>Spanish Message:</span> {{$closing->translate('es')->message}}</p>
        </span>
        <span>
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