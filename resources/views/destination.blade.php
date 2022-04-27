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

<div class="carousel presentation-carousel container wrapper">

    <carousel> :city="{{ \App\Models\CityImage::all() }}" </carousel>

</div>



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

        <div>
            отзывы и приглашение оставить отзыв
        </div>
    </main>

@endsection
<script>
    import Caruosel from "../js/components/Carousel";
    export default {
        components: {Caruosel}
    }
</script>
