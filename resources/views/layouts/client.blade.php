<!DOCTYPE html>
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
        window._token = '{{ session()->get('token') }}';
    </script>
</head>
<body>
<div id="app" class="overflow-x-hidden h-full">
    <header class="flex container justify-around md:justify-between list-none mx-auto mt-2 text-orangePantone font-bold w-screen">
        <div class="flex">
            <a href="{{ route('locale', 'en') }}">
                <img class="cursor-pointer w-6 h-6 mx-2 transform hover:translate-y-1 hover:scale-105 transition-all duration-300" src="{{asset('images/united-states.png')}}"/>
            </a>
            <a href="{{ route('locale', 'es') }}">
                <img class="cursor-pointer w-6 h-6 transform hover:translate-y-1 hover:scale-105 transition-all duration-300" src="{{asset('images/spain.png')}}"/>
            </a>
        </div>
        <div class="block text-center sm:flex justify-end">
            @guest
                @if (Route::has('login'))
                    <li class="px-3">
                        <i class="fas fa-sign-in-alt"></i>
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
                        <i class="fas fa-user"></i>
                        {{ Auth::user()->name }}
                    </a>

                    <div>
                        <a class="cursor-pointer text-gray-400"
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

    </header>
    <div>
        <main>
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
