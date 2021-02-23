<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex, nofollow">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;1,700&display=swap" rel="stylesheet">     

    <!-- Styles -->
    <link href="{{ asset('css/newadmin.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <main>
            @if ($flash=session('message'))
                <div class="alert alert-success" role="alert">{{$flash}}</div>
            @endif
            @yield('content')
            <div class="footer">
                <a class="btn btn-info" href="{{route('admin.menulist')}}">Admin</a>
            </div>
        </main>
    </div>
</body>
</html>
