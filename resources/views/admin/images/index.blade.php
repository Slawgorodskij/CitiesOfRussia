@extends('layouts.admin')

@section('title')
Список фото - @parent
@stop

@section('content-header')
<h1>Список фото</h1>
<a href="{{ route('admin.images.create') }}" class="admin-panel__button">
    Загрузить фото
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
        @foreach ($images as $image)
        <tr>
            <td>{{ $image->id }}</td>
            <td>{{ $image->name }}</td>
            <td>{{ $image->created_at }}</td>
            <td>
                <delete-button url="/admin/images/{{ $image->id }}"
                    confirmation="Подтвердите удаление фото с #ID {{ $image->id }}?">
                </delete-button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $images->links() }}
@endsection
