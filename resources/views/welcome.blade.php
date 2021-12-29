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
        <div class="welcomePage__header md:text-lg">
            @auth
                <a href="{{ url('/home') }}" class="m-4 hover:text-dimGray">{{ __('Home') }}</a>
            @else
                <a href="{{ route('login') }}" class="m-4 hover:text-dimGray">{{ __('Login') }}</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="m-4 hover:text-dimGray">{{ __('Register') }}</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="flex justify-center mt-8">
        <div class="flex flex-col items-center mt-8">
            <div class="flex flex-row font-bold mb-4">
                <img class="w-14 md:w-24" src="{{ asset('images/mercatodo-logo.png') }}">
                <h1 class="text-black text-2xl md:text-5xl m-2">
                    {{ config('app.name', 'Laravel') }}
                </h1>
            </div>
            <p class="text-sm md:text-xl my-4 text-center w-2/4"> Bienvenido a MercaTodo, tienda virtual donde podrás encontrar todo tipo de productos para ti y toda la familia </p>
            <p class="text-orangePantone font-bold text-sm md:text-lg my-4">"MercaTodo donde lo tienes TODO"</p>
            <img class="w-28 md:w-40" src="{{ asset('images/customer.png') }}">
        </div>
    </div>
</div>
</body>
</html>
