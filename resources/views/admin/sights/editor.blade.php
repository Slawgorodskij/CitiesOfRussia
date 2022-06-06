@extends('layouts.admin')

@section('title')
    Редактор достопримечательности - @parent
@stop

@section('content-header')
    <h1>{{ isset($sight) ?
        ('Редактирование информации о достопримечательности: ' . $sight->name) :
        ('Добавление достопримечательности') }}</h1>
@endsection

@section('content')

    <div class="block-form container">
        <form method="POST"
              action="{{ isset($sight) ? route('admin.sights.update', $sight) : route('admin.sights.store') }}"
              enctype="multipart/form-data">
            @csrf

            @if(isset($sight))
                @method('PUT')
            @endif

            <select-city-acc></select-city-acc>

            @error('city_id')
            <p class="block-form__text-error">{{ $message }}</p>
            @enderror

            <input name="name" type="text" class="block-form__input @error('name') block-form__input_error @enderror"
                   placeholder="Название достопримечательности" value="{{ $sight->name ?? old('name') }}" required/>

            @error('name')
            <p class="block-form__text-error">{{ $message }}</p>
            @enderror

            <input name="description" type="text"
                   class="block-form__input @error('description') block-form__input_error @enderror"
                   placeholder="Короткая информация о достопримечательности"
                   value="{{ $sight->description ?? old('description') }}"
                   required/>

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

