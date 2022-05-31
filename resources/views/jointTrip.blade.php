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

        <div class="container wrapper">
            <h2 class="title">Вы можете продолжить регистрацию</h2>
            <form method="POST" class="block-form block-form_mb" action="{{route('joint.store')}}">
                @csrf

                <input name="departure_city" type="text"
                       class="block-form__input @error('departure_city') block-form__input_error @enderror"
                       placeholder="Город отправления*"
                       value="{{$departureCity}}"
                />

                @error('departure_city')
                <p class="block-form__text-error">{{ $message }}</p>
                @enderror

                <input name="city_of_arrival" type="text"
                       class="block-form__input @error('city_of_arrival') block-form__input_error @enderror"
                       placeholder="Город прибытия*"
                       value="{{$cityOfArrival}}"
                />

                @error('city_of_arrival')
                <p class="block-form__text-error">{{ $message }}</p>
                @enderror

                <h3>В каком качестве вы желаете путешествовать</h3>
                <label class="presentation-block__form_label">
                    <input hidden
                           type="checkbox"
                           name="driver"
                           value="{{$userId}}">
                    <span class="block-form__role-user">водителя</span>
                </label>

                <label class="presentation-block__form_label">
                    <input hidden type="checkbox" name="passenger_first" value="{{$userId}}">
                    <span class="block-form__role-user">1-го пассажира</span>
                </label>

                <label class="presentation-block__form_label">
                    <input hidden type="checkbox" name="passenger_two" value="{{$userId}}">
                    <span class="block-form__role-user">2-го пассажира</span>
                </label>

                <label class="presentation-block__form_label">
                    <input hidden type="checkbox" name="passenger_three" value="{{$userId}}">
                    <span class="block-form__role-user">3-го пассажира</span>
                </label>


                <h3>Укажите период путешествия</h3>

                <label>
                    <span>Начало путешествия</span>
                    <input class="block-form__input" type="date" name="start">
                </label>

                <label>
                    <span>Окончание путешествия</span>
                    <input class="block-form__input" type="date" name="finish">
                </label>


                <button type="submit"
                        class="block-form__button">
                    Зарегистрировать поездку
                </button>
            </form>

            @isset($dataTrips[0])
                <h2 class="title">Или присоединиться к одной из существующих поездок</h2>
                <div class="presentation">
                    @foreach($dataTrips as $dataTrip)
                        <div class="presentation-block">
                            <img class="presentation-block__photo" src="{{$dataTrip['PhotoCityOfArrival']}}"
                                 alt="фотография города">
                            <div class="presentation-block__people">
                                <h3 class="title">{{$dataTrip['departureCity']}} - {{$dataTrip['cityOfArrival']}}</h3>
                                <h3>Период</h3>
                                <p>с <span> {{$dataTrip['start']}}</span> - по <span>{{$dataTrip['finish']}}</span></p>

                                <p>Водитель:
                                    <span>{{$dataTrip['driverFirstname'] ?: 'место свободно'}} {{$dataTrip['driverLastname']?:''}}</span>
                                </p>

                                <p>Пассажир:
                                    <span>{{$dataTrip['passengerFirstFirstname'] ?: 'место свободно'}} {{$dataTrip['passengerFirstLastname']?:''}}</span>
                                </p>

                                <p>Пассажир:
                                    <span>{{$dataTrip['passengerTwoFirstname'] ?: 'место свободно'}} {{$dataTrip['passengerTwoLastname']?:''}}</span>
                                </p>

                                <p>Пассажир:
                                    <span>{{$dataTrip['passengerThreeFirstname'] ?: 'место свободно'}} {{$dataTrip['passengerThreeLastname']?:''}}</span>
                                </p>

                            </div>

                            <div class="presentation-block__hover presentation-block__hover_trip">
                                @if($dataTrip['driverName']
                                 && $dataTrip['passengerFirstName']
                                 && $dataTrip['passengerTwoName']
                                 && $dataTrip['passengerThreeName'])
                                    <p>Свободных мест нет</p>
                                @else
                                    <h2>Желаю присоединиться в качестве:</h2>
                                    <form method="POST" class="presentation-block__form"
                                          action="{{route('joint.update', $dataTrip['trip'])}}">
                                        @csrf
                                        @method('PUT')
                                        @if(empty($dataTrip['driverName']))
                                            <label class="presentation-block__form_label">
                                                <input hidden
                                                       type="checkbox"
                                                       name="driver"
                                                       value="{{$userId}}">
                                                <span>водителя</span>
                                            </label>
                                        @endif

                                        @if(empty($dataTrip['passengerFirstName']))
                                            <label class="presentation-block__form_label">
                                                <input hidden type="checkbox" name="passenger_first"
                                                       value="{{$userId}}">
                                                <span>1-го пассажира</span>
                                            </label>
                                        @endif

                                        @if(empty($dataTrip['passengerTwoName']))
                                            <label class="presentation-block__form_label">
                                                <input hidden type="checkbox" name="passenger_two" value="{{$userId}}">
                                                <span>2-го пассажира</span>
                                            </label>
                                        @endif

                                        @if(empty($dataTrip['passengerThreeName']))
                                            <label class="presentation-block__form_label">
                                                <input hidden type="checkbox" name="passenger_three"
                                                       value="{{$userId}}">
                                                <span>3-го пассажира</span>
                                            </label>
                                        @endif
                                        <button type="submit"
                                                class="block-form__button">
                                            Присоединиться к поездке
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

            @endisset
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


