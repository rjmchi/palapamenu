@extends('layouts.app')
@section('content')
    <div class="w-full">
    <div class="menupage flex justify-between mt-4">
        @include('partials.menu')
        @include('partials.order')
    </div><!-- menupage -->
    </div><!-- container-->
@endsection