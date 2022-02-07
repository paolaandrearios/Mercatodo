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

    <script>
        window._locale = '{{ app()->getLocale() }}';
        window._translations = {!! Helper::getTranslation() !!};
        window._asset = '{{ asset('') }}';
    </script>
</head>
<body>
    <div id="app" class="overflow-hidden">
        <div class="flex bg-orangePantone p-3">
            <a href="{{ route('locale', 'en') }}">
                <img class="cursor-pointer w-6 h-6 mx-2 transform hover:translate-y-1 hover:scale-105 transition-all duration-300" src="{{asset('images/united-states.png')}}"/>
            </a>
            <a href="{{ route('locale', 'es') }}">
                <img class="cursor-pointer w-6 h-6 transform hover:translate-y-1 hover:scale-105 transition-all duration-300" src="{{asset('images/spain.png')}}"/>
            </a>
        </div>
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
