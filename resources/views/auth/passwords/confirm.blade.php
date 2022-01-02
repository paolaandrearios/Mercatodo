@extends('layouts.app', ['showHeader' => true, 'showSidebar' => false ])

@section('content')
<div class="">
    <div class="">
        <div class="">
            <div class="">
                <div class="">{{ __('Confirm Password') }}</div>

                <div class="">
                    {{ __('Please confirm your password before continuing.') }}

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="">
                            <label for="password">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="" >
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="">
                            <div class="">
                                <button type="submit" class="">
                                    {{ __('Confirm Password') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
