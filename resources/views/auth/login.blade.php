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
<body class="bodyLogin">
    <div class="login">
        <div class="login__container">
            <div class="login__container--logo">
                <a class="flex" href="{{ url('/') }}">
                    <img src="{{ asset('images/mercatodo-logo.png') }}">
                    <h1>
                        {{ config('app.name', 'Laravel') }}
                    </h1>
                </a>
            </div>
            @error('msg')
            <div class="text-orangePantone mb-3 text-sm">
                <strong>{{ $message }}</strong>
            </div>
            @enderror
            <div class="login__container--title">{{ __('auth.login.login') }}</div>
            <div class="login__container--form">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div>
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('auth.login.email') }}</label>

                        <div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <div class="input-error">
                                    <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="password" class="">{{ __('auth.login.password') }}</label>

                        <div>
                            <input id="password" type="password"  name="password" required autocomplete="current-password">

                            @error('password')
                            <div class="input-error" role="alert">
                                    <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <div>
                            <div class="input-checkbox">
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label for="remember">
                                    {{ __('auth.login.remember-me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="login-button">
                        <button type="submit">
                            {{ __('auth.login.login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                {{ __('auth.login.forgot-password') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
    <figure class="bodyLogin__image">
        <img src="{{ asset('images/shopping-basket.png') }}">
    </figure>
</body>
</html>
