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
    <admin-table :data="{{ json_encode($data) }}" :options="{{ json_encode($options) }}">
    </admin-table>
@endsection
