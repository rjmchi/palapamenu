@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4>{{__('The Palapa is now closed for on-line orders')}}</h4>
        </div>
    </div>
    @include('menu')
</div>

@endsection
