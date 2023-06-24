<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex, nofollow">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;1,700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <main class="m-5">
            @if ($flash=session('message'))
                <div class="alert alert-success" role="alert">{{$flash}}</div>
            @endif

            @yield('content')

            <div class="mt-5">
                <a href="{{route('admin')}}" class="btn btn-secondary" >Admin</a>
                <a href="{{route('closing.index')}}" class="btn btn-secondary" >Closings</a>
            </div>
        </main>
    </div>
</body>
</html>
