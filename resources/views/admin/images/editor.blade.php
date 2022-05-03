@extends('layouts.admin')

@section('title')
Загрузка фото - @parent
@stop

@section('content-header')
<h1>Загрузка фото</h1>
@endsection

@section('content')
<div class="block-form container">
    <form>

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

    </form>
</div>
@endsection
