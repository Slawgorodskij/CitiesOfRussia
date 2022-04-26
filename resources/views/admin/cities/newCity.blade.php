@extends('layouts.admin')

@section('title')
Добавить город - @parent
@stop

@section('content-header')
<h1>{{ isset($sity) ? ('Редактирование информации о городе:' . ' ' . $sity->name) : ('Добавление города') }}</h1>
@endsection

@section('content')
<div class="block-form container">
    <form method="POST" action="{{ isset($city) ? route('admin.cities.update', $city) : route('admin.cities.store') }}"
        enctype="multipart/form-data">
        @csrf

        @if(isset($city))
        @method('PUT')
        @endif

        <input name="name" type="text" class="block-form__input @error('name') block-form__input_error @enderror"
            placeholder="Название города" value="{{ $city->name ?? '' }}" />

        @error('name')
        <p class="block-form__text-error">{{ $message }}</p>
        @enderror

        <input name="description" type="text"
            class="block-form__input @error('description') block-form__input_error @enderror"
            placeholder="Короткая информация о городе" value="{{ $city->description ?? '' }}" />

        @error('description')
        <p class="block-form__text-error">{{ $message }}</p>
        @enderror

        <div>
            <label for="images">Загрузить изображения</label>
            <input type="file" name="images[]" id="images" multiple>
        </div>

        <x-forms.tinymce-editor />

        <button type="submit"
            class="block-form__button text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium"
            value="save">
            Сохранить
        </button>
    </form>
</div>
@endsection
