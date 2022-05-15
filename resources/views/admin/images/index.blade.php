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
    <admin-table :data="{{ json_encode($data) }}" :options="{{ json_encode($options) }}">
    </admin-table>
@endsection
