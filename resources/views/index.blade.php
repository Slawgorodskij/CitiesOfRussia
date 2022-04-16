@extends('layouts.main')

@section('title')
    Города России - @parent
@stop

@section('content')
    <main>
        <div class="performance wrapper">
            <div class="container">
                <h1 class="performance__title">
                    Россия - одна из великих мировых держав.
                </h1>
                <h2 class="performance__text">
                    Территория составляет более 17 миллионов квадратных километров,
                    на которых располагается более 1100 городов, образованных в
                    85 регионах.
                </h2>
            </div>
        </div>

        <section class="presentation container wrapper">
            @foreach($cities as $city)

                <div class="presentation-block">
                    <img class="presentation-block__photo" src="{{$city->images[0]['name']}}" alt="фотография города">
                    <div class="presentation-block__text">
                        {{$city->name}}
                    </div>
                    <div class="presentation-block__hover">
                        <a class="presentation-block__hover_link" href="{{ route('cities.index', ['city' => $city]) }}">
                            <h3>{{$city->description}}</h3>
                        </a>
                    </div>
                </div>
            @endforeach
        </section>
    </main>

@endsection
