@extends('layouts.app')

@section('content')
<div class="resetPassword">
      <div class="resetPassword__container">
        <figure>
            <img src="{{ asset('images/reset-password.png') }}">
        </figure>
        <div class="resetPassword__container--title">{{ __('Reset Password') }}</div>
        <div>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" class="input" value="{{ $token }}">

                <div>
                    <label for="email" class="">{{ __('E-Mail Address') }}</label>

                    <div>
                        <input id="email" type="email" class="input @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <div class="resetError" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="password">{{ __('Password') }}</label>

                    <div>
                        <input id="password" type="password" class="input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <div class="resetError" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="password-confirm">{{ __('Confirm Password') }}</label>

                    <div>
                        <input id="password-confirm" type="password" class="input" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div>
                    <div class="w-full md:w-2/3 mt-2">
                        <button type="submit" class="button">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
