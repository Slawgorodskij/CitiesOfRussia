@extends('layouts.main')

@section('title')
    Статьи
@endsection

@section('content')
    <div>articles
        <div class="h4"><a href = ''>Список статей</a></div>
        @forelse ($articles as $item)
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div>{!!  $item->title !!}</div>
                        <div>{!!  $item->description !!}</div>
                        <div>{!!  $item->text !!}</div>
                    </div>

                </div>
                <p>
                    <a class="btn btn-primary" href='{{ route('admin::test::update', ['article' => $item->id]) }}'>Update</a>
                    <a class="btn btn-danger" href='{{ route('admin::test::delete', ['id' => $item->id]) }}'>Delete</a>
                </p>
            </div>
            <hr>

        @empty
            <div>No news</div>
        @endforelse
        <hr>
        <div class="row justify-content-center">
            {{$articles->links()}}
        </div>
    </div>
@endsection


