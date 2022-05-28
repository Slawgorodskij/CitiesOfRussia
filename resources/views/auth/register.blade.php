@extends('layouts.main')

@section('title')
Регистрация - @parent
@stop

@section('content')
<main class="auth">
    <div class="card">
        <div class="card__header">{{ __('Register') }}</div>

        <div class="card__body">
            <form class="form" method="POST" action="{{ route('register') }}">
                @csrf

                <label for="name" class="form__label">{{ __('Name') }}</label>

                <div class="form__group">
                    <input id="name" type="text" class="form__field @error('name') form__field_invalid @enderror"
                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                    <span class="form__error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <label for="email" class="form__label">{{ __('Email Address') }}</label>

                <div class="form__group">
                    <input id="email" type="email" class="form__field @error('email') form__field_invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email">

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
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
