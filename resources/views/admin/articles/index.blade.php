@extends('layouts.admin')

@section('title')
Список статей - @parent
@stop

@section('content-header')
<h1>Список статей</h1>
<a href="{{ route('admin.articles.create') }}" class="admin-panel__button">
    Добавить статью
</a>
@endsection

@section('content')
<table class="admin-panel__table">
    <thead>
        <tr>
            <th>#ID</th>
            <th>Название</th>
            <th>Дата добавления</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($articles as $article)
        <tr>
            <td>{{ $article->id }}</td>
            <td>{{ $article->title }}</td>
            <td>{{ $article->created_at }}</td>
            <td>
                <a href="{{ route('admin.articles.edit', ['article' => $article]) }}" class="admin-panel__button">
                    Редактировать
                </a>
                <delete-button url="/admin/articles/{{ $article->id }}"
                    confirmation="Подтвердите удаление статьи с #ID {{ $article->id }}?">
                </delete-button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $articles->links() }}
@endsection
