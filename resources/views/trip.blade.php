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

            <form method="POST" action="{{route('joint-trip')}}">
                @csrf

                @error('departure_city_name')
                <p class="block-form__text-error">{{ $message }}</p>
                @enderror

                @error('city_of_arrival_name')
                <p class="block-form__text-error">{{ $message }}</p>
                @enderror

                <select-city></select-city>

                <button type="submit"
                        class="block-form__button">
                    Продолжить регистрацию
                </button>

            </form>
        </div>

        @isset($dataTrips)

            <div class="presentation container wrapper">
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
                                            <input hidden type="checkbox" name="passenger_first" value="{{$userId}}">
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
                                            <input hidden type="checkbox" name="passenger_three" value="{{$userId}}">
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

        {{--        <x-travel-card :dataTrips={{$dataTrips}} :userId="{{$userId}}"/>--}}

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

