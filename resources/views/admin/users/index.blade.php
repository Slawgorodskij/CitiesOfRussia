@extends('layouts.admin')

@section('title')
    Список пользователей - @parent
@stop

@section('content-header')
    <h1>Список пользователей</h1>
    <a href="{{ route('admin.users.create') }}" class="admin-panel__button">
        Добавить пользователя
    </a>
@endsection

@section('content')
    <admin-table :data="{{ json_encode($data) }}" :options="{{ json_encode($options) }}">
    </admin-table>
@endsection
