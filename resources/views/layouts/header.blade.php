
        <nav class="header">
            <div class="header__logo">
                <img src="{{ asset('images/mercatodo-logo.png') }}">
                <a href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="header__navbar" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class=" ">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="text-white font-bold">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="">
                                <a class="" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li>
                                <a href="{{ route('register') }}">{{ __('Register') }}</a>
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
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class=" ">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>
