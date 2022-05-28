@extends('layouts.main')

@section('title')
Сбросить пароль - @parent
@stop

@section('content')
<main class="auth">
    <div class="card">
        <div class="card__header">{{ __('Reset Password') }}</div>

        <div class="card__body">
            @if (session('status'))
            <x-alert type="success" message="{{ session('status') }}"></x-alert>
            @endif

            <form class="form" method="POST" action="{{ route('password.email') }}">
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

                <div></div>

                <div class="form__group">
                    <button type="submit" class="form__button form__button_primary">
                        {{ __('Send Password Reset Link') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection
