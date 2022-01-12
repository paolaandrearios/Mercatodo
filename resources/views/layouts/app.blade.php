<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;700;900&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ url('images/mercatodo-logo.png') }}">

    <script src="https://kit.fontawesome.com/a6face6a40.js" crossorigin="anonymous"></script>
</head>
<body>
    <div id="app">
        <div>
            @if(!isset($showHeader)  || (isset($showHeader) && $showHeader))
                @include('layouts.header')
            @endif
        </div>

        <div class="flex">
            <div class="@if(!isset($showSidebar)  || (isset($showSidebar) && $showSidebar)) w-1/5 @else hidden @endif">
                @if(!isset($showSidebar)  || (isset($showSidebar) && $showSidebar))
                    @include('layouts.sidebar')
                @endif
            </div>
            <div class="@if(!isset($showSidebar)  || (isset($showSidebar) && $showSidebar)) w-4/5 @else w-full mx-auto @endif">
                <main class="py-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
</body>
</html>
