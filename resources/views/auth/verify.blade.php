@extends('layouts.app', ['showHeader' => true, 'showSidebar' => false ])

@section('content')
<div class="verifyEmail">
    <div class="verifyEmail__container">
        <div class="m-2 text-center">
            <div class="verifyEmail__container--title">{{ __('auth.login.verify-email') }}</div>
            @if (session('resent'))
                <div class="message">
                    {{ __('auth.login.verify-email-resent') }}
                </div>
            @endif

            {{ __('auth.login.verify-email-message') }}
            {{ __('auth.login.verify-email-message-check') }},
            <form method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="button">{{ __('auth.login.verify-email-button') }}</button>
            </form>
        </div>
        <figure class="w-full md:w-1/5">
            <img src="{{ asset('images/check.png') }}">
        </figure>

    </div>
</div>
@endsection
