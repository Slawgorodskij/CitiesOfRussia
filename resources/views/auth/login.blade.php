@extends('layouts.main')

@section('title')
Войти - @parent
@stop

@section('content')
<main class="auth">
    <div class="card">
        <div class="card__header">{{ __('Login') }}</div>

        <div class="card__body">
            <form class="form" method="POST" action="{{ route('login') }}">
                @csrf

                <label for="email" class="form__label">{{ __('Email Address') }}</label>

                <div class="form__group">
                    <input id="email" type="email" class="form__field @error('email') form__field_invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                    autocomplete="current-password">

                @error('password')
                <span class="form__error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                </div>

                <div></div>

                <div class="form__group">
                    <input class="form__check-input" type="checkbox" name="remember" id="remember" {{
                        old('remember') ? 'checked' : '' }}>

                    <label class="form__check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>

                <div></div>

                <div class="form__group">
                    <button type="submit" class="form__button form__button-primary">
                        {{ __('Login') }}
                    </button>

                    @if (Route::has('password.request'))
                    <a class="form__button form__button-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
