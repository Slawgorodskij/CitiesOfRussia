@extends('layouts.admin')

@section('title')
    Редактор пользователя - @parent
@stop

@section('content-header')
    <h1>{{ isset($user) ? 'Редактирование информации о пользователе: ' . $user->name : 'Добавление пользователя' }}
    </h1>
@endsection

@section('content')

    <div class="block-form container">
        <form method="POST" action="{{ isset($user) ? route('admin.users.update', $user) : route('admin.users.store') }}"
            enctype="multipart/form-data">
            @csrf

            @if (isset($user))
                @method('PUT')
            @endif

            <input name="name" type="text" class="block-form__input @error('name') block-form__input_error @enderror"
                placeholder="Имя пользователя" value="{{ $user->name ?? old('name') }}" required />

            @error('name')
                <p class="block-form__text-error">{{ $message }}</p>
            @enderror

            <input name="email" type="email" class="block-form__input @error('email') block-form__input_error @enderror"
                placeholder="Электронная почта" value="{{ $user->email ?? old('email') }}" required />

            @error('email')
                <p class="block-form__text-error">{{ $message }}</p>
            @enderror

            <input name="password" type="password"
                class="block-form__input @error('password') block-form__input_error @enderror" required
                autocomplete="new-password">

            @error('password')
                <p class="block-form__text-error">{{ $message }}</p>
            @enderror

            <input name="password_confirmation" type="password"
                class="block-form__input @error('password') block-form__input_error @enderror" required
                autocomplete="new-password">

            <fieldset>
                <legend>Админ?</legend>
                <div>
                    <input class="form-check-input" type="radio" name="is_admin" id="is-admin" value="1"
                        @if (isset($user) && $user->is_admin === true) checked @endif>
                    <label class="form-check-label" for="is-admin">Да</label>
                </div>
                <div>
                    <input class="form-check-input" type="radio" name="is_admin" id="is-not-admin" value="0"
                        @if (isset($user) && $user->is_admin === false) checked @endif>
                    <label class="form-check-label" for="is-not-admin">Нет</label>
                </div>
            </fieldset>

            <button type="submit" class="block-form__button" value="save">
                Сохранить
            </button>
        </form>
    </div>

@endsection
