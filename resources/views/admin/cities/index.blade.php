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
    <admin-table :data="{{ json_encode($data) }}" :options="{{ json_encode($options) }}">
    </admin-table>
@endsection
