@extends('layouts.app', ['showHeader' => true, 'showSidebar' => false ])

@section('content')
<div class="register">
    <div class="flex justify-center">
        <div class="register--title">{{ __('Register') }}</div>
        <figure>
            <img src="{{ asset('images/register.png') }}">
        </figure>
    </div>
    <form method="POST" action="{{ route('register') }}">
        <div class="register__container">
            @csrf

            <div>
                <label for="name">{{ __('Name') }}</label>

                <div>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                    <div class="registerError" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
            </div>

            <div>
                <label for="email">{{ __('E-Mail Address') }}</label>

                <div>
                    <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                    <div class="registerError">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
            </div>

            <div>
                <label for="password">{{ __('Password') }}</label>

                <div>
                    <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                    <div class="registerError" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
            </div>

            <div>
                <label for="password-confirm">{{ __('Confirm Password') }}</label>

                <div>
                    <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>
        </div>

        <div class="flex justify-center pb-3">
            <button class="button w-5/6 md:w-2/6" type="submit">
                {{ __('Register') }}
            </button>
        </div>
    </form>
</div>
@endsection
