<div class="presentation">
    @foreach($dataTrips as $dataTrip)
        <div class="presentation-block">
            <img class="presentation-block__photo" src="{{$dataTrip['PhotoCityOfArrival']}}"
                 alt="фотография города">
            <div class="presentation-block__people">
                <h3 class="title">{{$dataTrip['departureCity']}} - {{$dataTrip['cityOfArrival']}}</h3>

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
            </div>
        </div>
    @endforeach
</div>
