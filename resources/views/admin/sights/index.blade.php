@extends('layouts.admin')

@section('title')
    Список достопримечательностей - @parent
@stop

@section('content-header')
    <h1>Список достопримечательностей</h1>
    <a href="{{ route('admin.sights.create') }}" class="admin-panel__button">
        Добавить достопримечательность
    </a>
@endsection

@section('content')
    <admin-table :data="{{ json_encode($data) }}" :options="{{ json_encode($options) }}">
    </admin-table>
@endsection
