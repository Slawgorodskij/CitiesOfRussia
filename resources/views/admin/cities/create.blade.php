@extends('layouts.admin')

@section('title')
Добавить город - @parent
@stop

@section('content-header')
<h1>Добавить город</h1>
@endsection

@section('content')
<ckeditor :editor="editor" v-model="editorData" :config="editorConfig"></ckeditor>
@endsection
