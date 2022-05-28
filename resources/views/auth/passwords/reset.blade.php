@extends('layouts.main')

@section('title')
Сбросить пароль - @parent
@stop

@section('content')
<main class="auth">
    <div class="card">
        <div class="card__header">{{ __('Reset Password') }}</div>

        <div class="card__body">
            <form class="form" method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <label for="email" class="form__label">{{ __('Email Address') }}</label>

                <div class="form__group">
                    <input id="email" type="email" class="form__field @error('email') form__field_invalid @enderror"
                        name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="form__error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <label for="password" class="form__label">{{ __('Password') }}</label>

                <div class="form__group">
                    <input id="password" type="password"
                        class="form__field @error('password') form__field_invalid @enderror" name="password" required
                        autocomplete="new-password">

                    @error('password')
                    <span class="form__error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <label for="password-confirm" class="form__label">{{ __('Confirm Password') }}</label>

                <div class="form__group">
                    <input id="password-confirm" type="password" class="form__field" name="password_confirmation"
                        required autocomplete="new-password">
                </div>

                <div></div>

                <div class="form__group">
                    <button type="submit" class="form__button form__button_primary">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
