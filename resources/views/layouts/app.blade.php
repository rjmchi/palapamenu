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
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;1,700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <main>
            <div class="titlebar mx-auto bg-primary-600 flex flex-wrap shadow-lg justify-center">
                <h1 class="logo w-full text-white italic text-2xl text-center pb-1 my-1">{{ __("La Palapa Menu at Los Palmares") }}</h1>

                <div class="languages w-full text-center mb-3">
                        @if(count(config('app.languages')) > 1)
                            @foreach(config('app.languages') as $langLocale => $langName)
                                <a class="btn btn-secondary" href="{{ url()->current() }}?change_language={{ $langLocale }}">{{ $langName }}</a>
                            @endforeach
                        @endif
                </div>
</div>

            @if ($flash=session('message'))
                <div class="alert alert-success" role="alert">{{$flash}}</div>
            @endif
            @yield('content')
        </main>
    </div>
</body>
</html>
