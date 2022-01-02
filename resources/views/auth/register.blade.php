@extends('layouts.app')

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
                    <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                    <div class="registerError" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
            </div>

            <div>
                <label for="document_type">{{ __('general.register.document_type') }}</label>

                <div>
                    <select class="input" id="document_type" name="document_type">
                        <option value="">Select...</option>
                        <option value="CC">CC</option>
                        <option value="CE">CE</option>
                        <option value="NIT">NIT</option>
                    </select>

                    @error('document_type')
                    <div class="registerError" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
            </div>


            <div>
                <label for="document_number">{{ __('general.register.document_number') }}</label>

                <div>
                    <input id="document_number" type="text" class="@error('document_number') is-invalid @enderror" name="document_number" value="{{ old('document_number') }}" required autocomplete="document_number" autofocus>

                    @error('document_number')
                    <div class="registerError" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="address">{{ __('general.register.address') }}</label>

                <div>
                    <input id="address" type="text" class="@error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

                    @error('address')
                    <div class="registerError" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
            </div>


            <div>
                <label for="city">{{ __('general.register.city') }}</label>

                <div>
                    <input id="city" type="text" class="@error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city" autofocus>

                    @error('city')
                    <div class="registerError" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
            </div>


            <div>
                <label for="phone">{{ __('general.register.phone') }}</label>

                <div>
                    <input id="phone" type="text" class="@error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                    @error('phone')
                    <div class="registerError" role="alert">
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
