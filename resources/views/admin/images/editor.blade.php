@extends('layouts.admin')

@section('title')
Загрузка фото - @parent
@stop

@section('content-header')
<h1>Загрузка фото</h1>
@endsection

@section('content')
<div class="block-form container">
    <form method="POST" action="{{ route('admin.images.store') }}" enctype="multipart/form-data">
        @csrf

        <select-imageable selected-type="{{ request()->get('imageable_type') }}"
            selected-id="{{ request()->get('imageable_id') }}"></select-imageable>

        @error('imageable_type')
        <p class="block-form__text-error">{{ $message }}</p>
        @enderror

        @error('imageable_id')
        <p class="block-form__text-error">{{ $message }}</p>
        @enderror

        <images-upload></images-upload>

        @error('file')
        <p class="block-form__text-error">{{ $message }}</p>
        @enderror

        @error('description')
        <p class="block-form__text-error">{{ $message }}</p>
        @enderror

        <button type="submit" class="block-form__button" value="save">
            Отправить
        </button>

    </form>
</div>
@endsection
