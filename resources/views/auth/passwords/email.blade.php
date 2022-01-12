@extends('layouts.app', ['showHeader' => true, 'showSidebar' => false ])

@section('content')
<div class="resetLink">
    <div class="resetLink__container">
        <div class="resetLink__container--title">{{ __('passwords.reset-password') }}</div>
        <div class="flex">
            <div class="w-full md:w-4/5">
                @if (session('status'))
                    <div class="m-2 mb-4 text-sm font-bold">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div>
                        <label for="email">{{ __('general.web.user.email') }}</label>

                        <div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <div class="resetLinkMessage">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <div>
                            <button type="submit" class="button">
                                {{ __('passwords.reset-password-link') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <figure class="w-full md:w-1/5 m-auto">
                <img src="{{ asset('images/forgot-password.png') }}">
            </figure>
        </div>
    </div>
</div>
@endsection
