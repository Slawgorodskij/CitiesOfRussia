@extends('layouts.admin')

@section('title')
    Редактор города - @parent
@stop

@section('content-header')
    <h1>{{ isset($city) ? ('Редактирование информации о городе: ' . $city->name) : ('Добавление города') }}</h1>
@endsection

@section('content')

    <div class="block-form container">
        <form method="POST"
              action="{{ isset($city) ? route('admin.cities.update', $city) : route('admin.cities.store') }}"
              enctype="multipart/form-data">
            @csrf

            @if(isset($city))
                @method('PUT')
            @endif

            <input name="name" type="text" class="block-form__input @error('name') block-form__input_error @enderror"
                   placeholder="Название города" value="{{ $city->name ?? old('name') }}" required />

            @error('name')
            <p class="block-form__text-error">{{ $message }}</p>
            @enderror

            <input name="description" type="text"
                   class="block-form__input @error('description') block-form__input_error @enderror"
                   placeholder="Короткая информация о городе" value="{{ $city->description ?? old('description') }}"
                   required />

            @error('description')
            <p class="block-form__text-error">{{ $message }}</p>
            @enderror

            <button type="submit"
                    class="block-form__button"
                    value="save">
                Сохранить
            </button>
        </form>
    </div>

@endsection
