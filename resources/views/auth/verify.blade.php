@extends('layouts.main')

@section('title')
Подтвердите Ваш email-адрес - @parent
@stop

@section('content')
<main class="auth">
    <div class="card">
        <div class="card__header">{{ __('Verify Your Email Address') }}</div>

        <div class="card__body">
            @if (session('resent'))
            <x-alert type="success"
                message="{{ __('A fresh verification link has been sent to your email address.') }}">
            </x-alert>
            @endif

            <form method="POST" action="{{ route('verification.resend') }}">
                @csrf
                {{ __('Before proceeding, please check your email for a verification link.') }}
                {{ __('If you did not receive the email') }},
                <button type="submit" class="form__button form__button_link">
                    {{ __('click here to request another') }}
                </button>.
            </form>
        </div>
    </div>

</main>
@endsection
