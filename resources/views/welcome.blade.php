<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class=" ">
<div class=" ">
    @if(Route::has('login'))
        <div class=" ">
            @auth
                <a href="{{ url('/home') }}" class=" ">{{ __('Home') }}</a>
            @else
                <a href="{{ route('login') }}" class=" ">{{ __('Login') }}</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class=" ">{{ __('Register') }}</a>
                @endif
            @endauth
        </div>
    @endif

    <div class=" ">
        <div class=" ">
            <div>
                <h1 class=" ">
                    {{ config('app.name', 'Laravel') }}
                </h1>

            </div>
        </div>
    </div>
</div>
</body>
</html>
