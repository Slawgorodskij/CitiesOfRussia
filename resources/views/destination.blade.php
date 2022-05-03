@extends('layouts.main')

@section('title')
    {{$destination_data->name}} - @parent
@stop

@section('content')
    <main>

        <div class="destination wrapper">
            @isset($destination_data->images[0])
                <img class="destination__photo" src="{{$destination_data->images[0]['name']}}" alt="">
            @endisset
            <div class="destination__description">
                <h1 class="destination__title">
                    {{$destination_data->name}}
                </h1>
                <h2 class="destination__text">
                    {{$destination_data->description}}
                </h2>
            </div>
        </div>

        <div> Карусель фотографий</div>

        <article>
            Много текста про место
        </article>

        <section class="presentation container wrapper">

            @foreach($sights as $sight)

                <div class="presentation-block">
                    @isset($sight->images[0])
                        <img class="presentation-block__photo" src="{{$sight->images[0]['name']}}"
                             alt="фотография города">
                    @endisset
                    <div class="presentation-block__text">
                        {{$sight->name}}
                    </div>
                    <div class="presentation-block__hover">
                        <a class="presentation-block__hover_link"
                           href="{{route('sights.index',['city'=>$citySlug, 'sight'=>$sight->slug])}}">
                            <h3>{{$sight->description}}</h3>
                        </a>
                    </div>
                </div>
            @endforeach

        </section>

        <section>
            Приглашение найти попутчика
        </section>

        <div class="feedback-block">

            <h2 class="title">Отзывы наших пользователей</h2>

            <div class="feedback-block__items container">

                <div class="feedback-block__item">
                    <p class="feedback-block__text text"><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus architecto aspernatur atque deleniti dolore doloribus eum expedita hic incidunt laborum, minus, omnis possimus quam quos repellendus sequi tempore ut, voluptatibus!</span><span>Consectetur corporis cumque debitis dolorum earum eius, eligendi eos esse eum fugit illo in incidunt ipsum maxime minus nisi nostrum obcaecati quaerat quia, sed sit sunt totam vel? Ipsa, porro?</span>
                    </p>
                    <p class="feedback-block__author">Иван Иванов</p>
                </div>
                <div class="feedback-block__item">
                    <p class="feedback-block__text text"><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus architecto aspernatur atque deleniti dolore doloribus eum expedita hic incidunt laborum, minus, omnis possimus quam quos repellendus sequi tempore ut, voluptatibus!</span><span>Consectetur corporis cumque debitis dolorum earum eius, eligendi eos esse eum fugit illo in incidunt ipsum maxime minus nisi nostrum obcaecati quaerat quia, sed sit sunt totam vel? Ipsa, porro?</span>
                    </p>
                    <p class="feedback-block__author">Иван Иванов</p>
                </div>
                <div class="feedback-block__item">
                    <p class="feedback-block__text text"><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus architecto aspernatur atque deleniti dolore doloribus eum expedita hic incidunt laborum, minus, omnis possimus quam quos repellendus sequi tempore ut, voluptatibus!</span><span>Consectetur corporis cumque debitis dolorum earum eius, eligendi eos esse eum fugit illo in incidunt ipsum maxime minus nisi nostrum obcaecati quaerat quia, sed sit sunt totam vel? Ipsa, porro?</span>
                    </p>
                    <p class="feedback-block__author">Иван Иванов</p>
                </div>

            </div>

        </div>
    </main>

@endsection
