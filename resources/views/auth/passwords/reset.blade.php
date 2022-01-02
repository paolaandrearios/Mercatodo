@extends('layouts.app')

@section('content')
<div class="resetPassword">
      <div class="resetPassword__container">
          <div class="resetPassword__container--title">{{ __('Reset Password') }}</div>
          <div class="flex">
              <form class="w-full md:w-4/5" method="POST" action="{{ route('password.update') }}">
                  @csrf

                  <input type="hidden" name="token" value="{{ $token }}">

                  <div>
                      <label for="email">{{ __('E-Mail Address') }}</label>

                      <div>
                          <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                          @error('email')
                          <div class="resetError">
                              <strong>{{ $message }}</strong>
                          </div>
                          @enderror
                      </div>
                  </div>

                  <div>
                      <label for="password">{{ __('Password') }}</label>

                      <div>
                          <input id="password" type="password" name="password" required autocomplete="new-password">

                          @error('password')
                          <div class="resetError">
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

                  <div>
                      <div>
                          <button type="submit" class="button">
                              {{ __('Reset Password') }}
                          </button>
                      </div>
                  </div>
              </form>
              <figure class="w-full md:w-1/5 m-auto">
                  <img src="{{ asset('images/reset-password.png') }}">
              </figure>
          </div>
    </div>
</div>
@endsection
