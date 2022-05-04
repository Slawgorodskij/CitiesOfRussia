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

            <city :city="{{ \App\Models\CityImage::all() }}"></city>

        </section>


    </main>

@endsection
