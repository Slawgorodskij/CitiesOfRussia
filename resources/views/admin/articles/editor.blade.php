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

        {{-- CHANGE IT --}}
        <input type="text" name="articleable_type" id="articleable_type" value="{{ request()->get('articleable_type') }}" required>
        <input type="text" name="articleable_id" id="articleable_id" value="{{ request()->get('articleable_id') }}" required>

        <textarea name="article_body" id="editor">{!! $article->article_body ?? old('article_body') !!}</textarea>

        <button type="submit"
            class="block-form__button text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium"
            value="save">
            Сохранить
        </button>
    </form>
</div>
@endsection
