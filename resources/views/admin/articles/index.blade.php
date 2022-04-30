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
        @foreach ($articles as $article)
        <tr>
            <td>{{ $article->id }}</td>
            <td>{{ $article->title }}</td>
            <td>{{ $article->created_at }}</td>
            <td>
                <a href="{{ route('admin.articles.edit', ['article' => $article]) }}" class="admin-panel__button">
                    Редактировать
                </a>
                <a href="javascript:;" class="admin-panel__button delete" rel="{{ $article->id }}">
                    Удалить
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $articles->links() }}
@endsection

@push('js')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const elems = document.querySelectorAll('.delete');
        elems.forEach(element => {
            element.addEventListener('click', function() {
                const id = this.getAttribute('rel');
                if (confirm(`Подтвердите удаление статьи с #ID ${id}?`)) {
                    send(`/admin/articles/${id}`).then(() => {
                        location.reload();
                    });
                }
            });
        });
    });

    async function send(url) {
        let response = await fetch(url, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });

        let result = await response.json();
        return result.ok;
    }
</script>
@endpush
