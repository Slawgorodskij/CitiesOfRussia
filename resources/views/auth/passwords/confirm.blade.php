@extends('layouts.main')

@section('title')
Подтверждение пароля - @parent
@stop

@section('content')
<main class="auth">
    <div class="card">
        <div class="card__header">{{ __('Confirm Password') }}</div>

        <div class="card__body">
            <x-alert type="warning" message="{{ __('Please confirm your password before continuing.') }}"></x-alert>

            <form class="form" method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <label for="password" class="form__label">{{ __('Password') }}</label>

                <div class="form__group">
                    <input id="password" type="password"
                        class="form__field @error('password') form__field_invalid @enderror" name="password" required
                        autocomplete="current-password">

                    @error('password')
                    <span class="form_error" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div></div>

                <div class="form__group">
                    <button type="submit" class="form__button form__button_primary">
                        {{ __('Confirm Password') }}
                    </button>

                    @if (Route::has('password.request'))
                    <a class="form__button form__button_link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
