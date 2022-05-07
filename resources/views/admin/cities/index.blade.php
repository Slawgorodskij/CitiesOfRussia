@extends('layouts.admin')

@section('title')
Список городов - @parent
@stop

@section('content-header')
<h1>Список городов</h1>
<a href="{{ route('admin.cities.create') }}" class="admin-panel__button">
    Добавить город
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
        @foreach ($cities as $city)
        <tr>
            <td>{{ $city->id }}</td>
            <td>{{ $city->name }}</td>
            <td>{{ $city->created_at }}</td>
            <td>
                <a href="{{ route('admin.cities.edit', ['city' => $city]) }}" class="admin-panel__button">
                    Редактировать
                </a>
                <delete-button url="/admin/cities/{{ $city->id }}"
                    confirmation="Подтвердите удаление города с #ID {{ $city->id }}?">
                </delete-button>
                <a href="{{ route('admin.articles.create', ['articleable_type' => class_basename($city::class), 'articleable_id' => $city->id]) }}"
                    class="admin-panel__button">
                    Добавить статью
                </a>
                <a href="{{ route('admin.images.create', ['imageable_type' => class_basename($city::class), 'imageable_id' => $city->id]) }}"
                    class="admin-panel__button">
                    Загрузить фото
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $cities->links() }}
@endsection
