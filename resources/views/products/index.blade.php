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
    <link rel="icon" href="{{ url('images/mercatodo-logo.png') }}">
</head>
<body class="welcomePage">
<div>
    @guest
        @if (Route::has('login'))
            <li class="">
                <a class="" href="{{ route('login') }}">{{ __('auth.login.login') }}</a>
            </li>
        @endif

        @if (Route::has('register'))
            <li>
                <a href="{{ route('register') }}">{{ __('general.web.user.register-in') }}</a>
            </li>
        @endif
    @else
        <li>
            <a id="navbarDropdown" href="#" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div>
                <a class="cursor-pointer"
                   onclick="document.getElementById('logout-form').submit();">
                    {{ __('auth.login.logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class=" ">
                    @csrf
                </form>
            </div>
        </li>
    @endguest


</div>
</body>
</html>
