@extends('layouts.app')

@section('content')
    <div class="welcomePage__container">
        <div class="welcomePage__container--description">
            <p>{{__('general.welcome.welcome_description')}}</p>
            <p>{{__('general.welcome.slogan')}}</p>
            <div class="flex">
                <img src="{{ asset('images/shopping-basket.png') }}">
                <img src="{{ asset('images/buy.png') }}">
            </div>
        </div>
    </div>
@endsection
