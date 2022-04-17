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
        @foreach ($cities as $city)
        <tr>
            <td>{{ $city->id }}</td>
            <td>{{ $city->name }}</td>
            <td>{{ $city->created_at }}</td>
            <td>
                <a href="{{ route('admin.cities.edit', ['city' => $city]) }}" class="admin-panel__button">
                    Редактировать
                </a>
                <a href="javascript:;" class="admin-panel__button delete" rel="{{ $city->id }}">
                    Удалить
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $cities->links() }}
@endsection

@push('js')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const elems = document.querySelectorAll('.delete');
        elems.forEach(element => {
            element.addEventListener('click', function() {
                const id = this.getAttribute('rel');
                if (confirm(`Подтвердите удаление города с #ID ${id}?`)) {
                    send(`/admin/cities/${id}`).then(() => {
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
