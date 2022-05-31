@extends('layouts.auth')

@section('content')

    <div id="app">

        <div class="container-fluid p-3 text-center bg-white border"
             style="background-image: url(/storage/images/road.jpg); background-size: cover;">
            <h3 class="text-white-50">Профиль</h3>
        </div>
    </div>

    <div class="container">
        <div class="row">

            <div class="container p-5 mt-4 bg-white">
                <img src="/storage/images/face.jpg" class="rounded" alt="Cinque Terre">
                <div class="form-group col-2 d-flex">
                    <h6 class="p-2 bg-primary text-white">Загрузить фотографию</h6>
                </div>
            </div>

            <div class="container p-5 mt-4 bg-white">
                <div class="row">
                    <div class="col">
                        <h4 id="s2" class="text-primary">Изменить данные профиля</h4>
                        <form method="POST"
                              action="{{ isset($profile) ? route('account', $profile) : route('profile.store') }}"
                              class="needs-validation" novalidate>
                            @csrf
                            <div class="row">
                                <div class="form-group col">
                                    <label for="uname">Имя:</label>

                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                    <input name="firstname" type="text"
                                           class="form-control block-form__input @error('firstname') block-form__input_error @enderror"
                                           placeholder="" value="{{ $profile->firstname ?? $user ->name }}" required>


                                    <label for="lastname">Фамилия:</label>
                                    <input type="text" class="form-control" class="lastname" placeholder=""
                                           name="lastname"
                                           value="{{ $profile->lastname ?? old('lastname') }}" required>


                                    <label for="patronymic">Отчество:</label>
                                    <input type="text" class="form-control" class="patronymic" placeholder=""
                                           name="patronymic"
                                           value="{{ $profile->patronymic ?? old('patronymic') }}" required>


                                </div>
                                <div class="form-group col">
                                    <label for="phone">Телефон:</label>
                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                    <input name="phone" type="tel"
                                           class="form-control block-form__input @error('phone') block-form__input_error @enderror"
                                           placeholder="+(7)123-456-67-89" value="{{ $profile->phone ?? old('phone') }}"
                                           pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required>


                                    <label for="email">Email:</label>
                                    <input type="text" class="form-control" class="email" placeholder="" name="email"
                                           value="{{ $user->email ?? old('$user->email') }}" required>


                                    <label for="location">Город:</label>
                                    <input type="text" class="form-control" class="location" placeholder="" name="city"
                                           value="{{ $profile->city ?? old('city') }}" required>


                                </div>
                                <div class="row">
                                    <div class="form-group col-3">
                                        <label for="date_of_birth">Дата рождения:</label>
                                        <input type="date" class="form-control" id="date_of_birth"
                                               placeholder="Краткая информация о пассажире" name="date_of_birth"
                                               value="{{ $profile->date_of_birth ?? old('date_of_birth') }}" required>

                                    </div>
                                </div>
                                <div class="form-group col">
                                    <label for="personalinfo">О себе:</label>
                                    <input type="text" class="form-control" id="personalinfo" placeholder=""
                                           name="personalinfo"
                                           value="{{ $profile->personalinfo ?? old('personalinfo') }}">

                                </div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
