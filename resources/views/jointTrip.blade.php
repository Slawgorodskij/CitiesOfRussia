@extends('layouts.main')

@section('title')
    Совместные поездки - @parent
@stop

@section('content')
    <main>

        <div class="trip">

            <h1 class="trip__title title trip__title_mb100">
                Совместные поездки
            </h1>

            <div class="trip-description container">

                <p>Россия большая многообразная страна.</p>
                <p>Мы стремимся рассказать и виртуально показать красоту нашей родины, пробудить
                    интерес к путешествию.</p>
                <p>Способствовать встрече людей желающих посетить понравившееся место.</p>
                <p>Вы, наши соотечественники, можете помочь друг другу в познании её</p>

            </div>

        </div>

        <div class="feedback-block">

            <h2 class="title">Отзывы наших пользователей</h2>

            <div class="feedback-block__items container">

                @foreach($comments as $comment)
                    <div class="feedback-block__item">
                        <p class="feedback-block__text text">{{$comment['object']}}</p>
                        <p class="feedback-block__text text">{{$comment['comment_body']}}</p>
                        <p class="feedback-block__author">{{$comment['firstname']}} {{$comment['lastname']}}</p>
                    </div>
                @endforeach

            </div>

        </div>

    </main>

@endsection


