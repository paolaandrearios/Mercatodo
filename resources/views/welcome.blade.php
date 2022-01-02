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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="welcomePage">
<div>
    @if(Route::has('login'))
        <div class="welcomePage__header">
            @auth
                <a href="{{ url('/home') }}">{{ __('Home') }}</a>
            @else
                <a href="{{ route('login') }}">{{ __('Login') }}</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="welcomePage__content">
        <div class="welcomePage__container">
            <div class="welcomePage__container--logo">
                <img src="{{ asset('images/mercatodo-logo.png') }}">
                <h1>
                    {{ config('app.name', 'Laravel') }}
                </h1>
            </div>
            <div class="welcomePage__container--description">
                <p>{{__('general.welcome.welcome_description')}}</p>
                <p>{{__('general.welcome.slogan')}}</p>
                <img src="{{ asset('images/customer.png') }}">
            </div>
        </div>
    </div>
</div>
</body>
</html>
