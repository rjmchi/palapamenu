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

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <main>

            <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="apphead">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Los Palmares') }}
                </a>
                <div id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @if(count(config('app.languages')) > 1)
                            @foreach(config('app.languages') as $langLocale => $langName)
                                <a class="lang" href="{{ url()->current() }}?change_language={{ $langLocale }}">{{ strtoupper($langLocale) }} ({{ $langName }})</a>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
            
            @if ($flash=session('message'))
                <div class="alert alert-success" role="alert">{{$flash}}</div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
</html>
