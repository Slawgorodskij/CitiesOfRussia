@extends('blocks.wysiwygSettings')

    <div class="row justify-content-center">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="col-md-8">
            <div class="h4">Создание статьи</div>
            <form action="{{ route('admin::test::save') }}" method="post" enctype="multipart/form-data">
                @csrf
                @if($article->id)
                    <input type="hidden" name="id" value="{{$article->id}}">
                @endif

                <div class="form-group">
                    <label>Название
                        <input type="text" name="title" class="form-control" value="{{ $article->title ?? old('title')  }}">
                    </label>
                    @error("title")
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Описание
                        <input type="text" name="description" class="form-control" value="{{ $article->description ?? old('description')  }}">
                    </label>
                    @error("description")
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Текст
                        <textarea name="text" class="form-control text" cols="30" rows="10">{{ $text ?? old('text') }}</textarea>
                    </label>
                    @error("text")
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Фотографии
                    <input multiple name="images[]" type="file">
                    </label>
                </div>

                <input type="submit" value="Создать" class="btn btn-success">
            </form>
        </div>
    </div>


