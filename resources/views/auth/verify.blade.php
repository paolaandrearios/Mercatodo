@extends('layouts.app')

@section('content')
<div class="verifyEmail">
    <div class="verifyEmail__container">
        <div class="m-2 text-center">
            <div class="verifyEmail__container--title">{{ __('Verify Your Email Address') }}</div>
            @if (session('resent'))
                <div class="message">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif

            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }},
            <form method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="button">{{ __('click here to request another') }}</button>
            </form>
        </div>
        <figure class="w-full md:w-1/5">
            <img src="{{ asset('images/check.png') }}">
        </figure>

    </div>
</div>
@endsection
