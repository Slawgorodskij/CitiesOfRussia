@extends('layouts.main')

@section('title')
    {{$destination_data->name}} - @parent
@stop

@section('content')
    <main>

        <div class="destination">
            @isset($destination_data->images[0])
                <img class="destination__photo" src="{{ asset($destination_data->images[0]['name']) }}" alt="">
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

        <div class="carousel wrapper">
            <h2 class="title">Что вы можете увидеть посетив "{{$destination_data->name}}" </h2>
            <carousel type="{{ class_basename($destination_data::class) }}" id="{{ $destination_data->id }}"></carousel>
        </div>

        @isset($destination_data->articles[0])
            <article>
                {!! Storage::get('public/articles/' . $destination_data->articles[0]->article_body) ??
                $destination_data->articles[0]->article_body !!}
            </article>
        @endisset

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

        <section class="destination-invitation">
            <div class="destination-invitation__advert">
                <div class="container">
                    @unless (Auth::check())
                        <h2>
                            Отправляйтесь в путешествие прямо сейчас! <br>
                            Выбирайте привлекательные города России, комбинируйте их в маршруты, и посетите проверенные
                            достопримечательности в нескучной компании случайных попутчиков!
                        </h2>
                        <a class="destination-invitation__advertlink" href='/login'>
                            Только зарегистрируйтесь!
                        </a>
                        <h2>
                            Счастливых путешествий и новых открытий!
                        </h2>
                    @else
                        <h2>
                            Вы уже с нами!
                        </h2>
                        <a class="destination-invitation__advertlink" href='/home'>
                            Выберите маршрут и попутчика прямо сейчас!
                        </a>
                    @endunless
                </div>


            </div>
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
<script>
    import Carousel from "../js/components/Carousel/Carousel";

    export default {
        components: {Carousel}
    }
</script>
