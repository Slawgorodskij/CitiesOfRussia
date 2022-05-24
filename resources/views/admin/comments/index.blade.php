@extends('layouts.admin')

@section('title')
    Список комментариев - @parent
@stop

@section('content-header')
    <h1>Список комментариев</h1>
    {{-- <a href="{{ route('admin.comments.create') }}" class="admin-panel__button">
        Добавить комментарий
    </a> --}}
@endsection

@section('content')
    <admin-table :data="{{ json_encode($data) }}" :options="{{ json_encode($options) }}">
    </admin-table>
@endsection
