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

            <div class="trip-rules container">
                <h2 class="trip__title title"> Воспользовавшись сайтом вы можете:</h2>
                <div class="trip-rules__items">
                    <div class="trip-rules__item">
                        <p>найти попутчика для посещения города, </p>
                        <p>разделить ваши расходы на поездку с попутчиками, </p>

                    </div>
                    <div class="trip-rules__item">
                        <p>видеть будущих попутчиков </p>
                        <p>почитать отзывы о будущих попутчиках </p>
                    </div>
                    <div class="trip-rules__item">
                        <p>оставить свой отзыв о попутчиках </p>
                        <p>оставить свой отзыв о посещенном городе </p>
                    </div>

                </div>

            </div>
        </div>

        <div class="block-form trip-form container">

            <h2 class="title">Регистрация поездки</h2>

            <form method="POST" action="#">
                @csrf

                <p class="block-form__label">Выберите свою роль в поездке</p>
                <select class="block-form__input" name="trip_role">
                    <option disabled>Выберите свою роль</option>
                    <option value="passenger">Пассажир</option>
                    <option value="driver">Водитель</option>
                </select>

                <p class="block-form__label">Выберите город отправления</p>
                <select class="block-form__input" name="departure_city">
                    <option disabled>Город отправления</option>
                    {{--                    @foreach($cities as $city)--}}
                    {{--                        <option value="{{$city->id}}">{{$city->name}}</option>--}}
                    {{--                    @endforeach--}}
                </select>

                <p class="block-form__label">Выберите город прибытия</p>
                <select class="block-form__input" name="city_arrival">
                    <option disabled>Город прибытия</option>
                    {{--                    @foreach($cities as $city)--}}
                    {{--                        <option value="{{$city->id}}">{{$city->name}}</option>--}}
                    {{--                    @endforeach--}}
                </select>

                <button type="submit"
                        class="block-form__button"
                        value="save">
                    Сохранить
                </button>

            </form>
        </div>

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

