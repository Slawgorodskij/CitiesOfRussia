@extends('layouts.admin')

@section('title')
Редактор статьи - @parent
@stop

@section('content-header')
<h1>{{ isset($article) ? ('Редактирование статьи: ' . $article->title) : ('Добавление статьи') }}</h1>
@endsection

@section('content')
<div class="block-form container">
    <form method="POST"
        action="{{ isset($article) ? route('admin.articles.update', $article) : route('admin.articles.store') }}"
        enctype="multipart/form-data">
        @csrf

        @if(isset($article))
        @method('PUT')
        @endif

        <input type="hidden" name="user_id" id="userId" value="{{ Auth::user()->id }}">

        <select-articleable selected-type="{{ request()->get('articleable_type') }}"
            selected-id="{{ request()->get('articleable_id') }}"></select-articleable>

        @error('articleable_type')
        <p class="block-form__text-error">{{ $message }}</p>
        @enderror

        @error('articleable_id')
        <p class="block-form__text-error">{{ $message }}</p>
        @enderror

        <input name="title" type="text" class="block-form__input @error('title') block-form__input_error @enderror"
            placeholder="Заголовок" value="{{ $article->title ?? old('title') }}" />

        @error('title')
        <p class="block-form__text-error">{{ $message }}</p>
        @enderror

        <input name="description" type="text"
            class="block-form__input @error('description') block-form__input_error @enderror"
            placeholder="Краткое описание" value="{{ $article->description ?? old('description') }}" />

        @error('description')
        <p class="block-form__text-error">{{ $message }}</p>
        @enderror

        <textarea name="article_body" id="editor">
            {!! $article->article_body ?? old('article_body') !!}
        </textarea>

        @error('article_body')
        <p class="block-form__text-error">{{ $message }}</p>
        @enderror

        <button type="submit"
            class="block-form__button text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium"
            value="save">
            Сохранить
        </button>
    </form>
</div>
@endsection
