@extends('layouts.admin')

@section('title')
Добавить город - @parent
@stop

@section('content-header')
<h1>Добавить город</h1>
@endsection

@section('content')
<form method="post" enctype="multipart/form-data">
    @csrf
    <textarea name="editor" id="editor" class="form-control">{!! old('editor') !!}</textarea>
    <button type="submit">Сохранить</button>
</form>
@endsection
