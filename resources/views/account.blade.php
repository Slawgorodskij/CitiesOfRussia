@extends('layouts.main')

@section('title')
    {{ Auth::user()->name }} - @parent
@stop

@section('content')
    <main class="account">

        <div class="banner">
            <h3 class="banner__text">Добро пожаловать!</h3>
        </div>

        <nav class="navbar">
            <ul class="navbar__list">
                <li class="navbar__item">
                    <a class="navbar__link" href="{{ route('profile.index') }}">Профиль</a>
                </li>
                <li class="navbar__item">
                    <a class="navbar__link" href="#">Мои города</a>
                </li>
                <li class="navbar__item">
                    <a class="navbar__link" href="{{ route('account.trip') }}">Мои поездки</a>
                </li>
                <li class="navbar__item">
                    <a class="navbar__link" href="#">Мои попутчики</a>
                </li>
                {{-- <li class="navbar__item">
                    <a class="navbar__link" href="{{ route('index') }}">Вернуться на главную</a>
                </li> --}}
            </ul>
        </nav>

        <div class="account__container">

            <div class="account__card grid-col-1-2">
                <div>
                    <img src="/images/face.jpg" class="avatar" alt="{{ $user->name }}">
                    <h2>{{ $user->name }}</h2>
                    <h5>{{ $user->email }}</h5>
                    <nav class="page-navigation">
                        <h3>Переход по странице</h3>
                        <ul class="page-navigation__list">
                            <li class="page-navigation__item">
                                <a class="page-navigation__link" href="#s1">Мой статус</a>
                            </li>
                            <li class="page-navigation__item">
                                <a class="page-navigation__link" href="#s2">Стать попутчиком</a>
                            </li>
                            <li class="page-navigation__item">
                                <a class="page-navigation__link" href="#s3">Стать водителем</a>
                            </li>
                            <li class="page-navigation__item">
                                <a class="page-navigation__link" href="#s4">Оставить комментарий</a>
                            </li>
                            <li class="page-navigation__item">
                                <a class="page-navigation__link" href="#s5">Отзывы обо мне</a>
                            </li>
                            {{-- <li class="page-navigation__item">
                                <a class="page-navigation__link" href="#">Полезная информация</a>
                            </li> --}}
                        </ul>
                    </nav>
                </div>
                <div>
                    <div class="comment-block">
                        @foreach ($cityComments as $key => $array)
                            <h2 class="text-primary">Город {{ $array['city']->name }}</h2>
                            @foreach ($array['comments'] as $comment)
                                <h5>Комментарий от {{ $comment->created_at }}</h5>
                                <p>"{{ $comment->comment_body }}"</p>
                            @endforeach
                        @endforeach
                        <p>Some text..</p>
                    </div>
                    <div class="comment-block">
                        @foreach ($sightComments as $key => $array)
                            <h2 class="text-primary">Достопримечательность<br>{{ $array['sight']->name }}</h2>
                            @foreach ($array['comments'] as $comment)
                                <h5>{{ $comment->created_at }}</h5>
                                <p>"{{ $comment->comment_body }}"</p>
                            @endforeach
                        @endforeach
                    </div>
                    <p>Some text..</p>
                </div>
            </div>

            <div class="account__card">
                <div class="row">
                    <h4 id="s1" class="text-primary">Мой статус: </h4>
                    @if ($carinfo)
                        <p>Водитель</p>
                        <p>Автомобиль <span style="font-weight:bold">{{ $carinfo->car }}</span> госномер <span
                                style="font-weight:bold">{{ $carinfo->registration_number }}</span></p>
                    @endif
                </div>
            </div>

            {{-- <div class="account__card">
                <h4 class="text-primary">Информация о предложениях и возможностях </h4>
            </div> --}}

            <div class="account__card">
                <h4 id="s2" class="text-primary">Стать попутчиком</h4>
                <p>Введите необходимые данные:</p>
                <form class="form" method="POST"
                      action="{{ isset($profile) ? route('account', $profile) : route('profile.store') }}"
                      class="needs-validation" novalidate>
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <div class="form__group grid-12">
                        <div class="form__group firstname">
                            <label class="form__label" for="uname">Имя:</label>
                            <input type="text" class="form__field" class="firstname" placeholder="" name="firstname"
                                   value="{{ $profile->firstname ?? old('firstname') }}" required>
                        </div>
                        <div class="form__group lastname">
                            <label class="form__label" for="lastname">Фамилия:</label>
                            <input type="text" class="form__field" class="lastname" placeholder="" name="lastname"
                                   value="{{ $profile->lastname ?? old('lastname') }}" required>
                        </div>
                        <div class="form__group patronymic">
                            <label class="form__label" for="patronymic">Отчество:</label>
                            <input type="text" class="form__field" class="patronymic" placeholder=""
                                   name="patronymic" value="{{ $profile->patronymic ?? old('patronymic') }}" required>
                        </div>
                        <div class="form__group birthday">
                            <label class="form__label" for="date_of_birth">Дата рождения:</label>
                            <input type="date" class="form__field" id="date_of_birth"
                                   placeholder="Краткая информация о пассажире" name="date_of_birth"
                                   value="{{ $profile->date_of_birth ?? old('date_of_birth') }}" required>
                        </div>
                        <div class="form__group personalinfo">
                            <label class="form__label" for="personalinfo">Обо мне:</label>
                            <input type="text" class="form__field" id="personalinfo"
                                   placeholder="Краткая информация обо мне, как пассажире" name="personalinfo"
                                   value="{{ $profile->personalinfo ?? old('personalinfo') }}">
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="form__button form__button_primary">Ввести</button>
                </form>
            </div>

            <div class="account__card">
                <h4 id="s3" class="text-primary">Стать водителем</h4>
                <p>Введите необходимые данные об автомобиле:</p>
                <form class="form" method="POST"
                      action="{{ isset($driver) ? route('account', $driver) : route('driver.store') }}"
                      class="needs-validation" novalidate>
                    @csrf
                    <div class="form__group">
                        <label class="form__label" for="driving_license">Водительское удостоверение:</label>
                        <input type="text" class="form__field" placeholder="Номер и дата выдачи" name="driving_license"
                               value="{{ $driver->driving_license ?? old('driving_license') }}" required>
                        @error('driving_license')
                        <span class="form__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form__group grid-col-1-1">
                        <div class="form__group">
                            <label class="form__label" for="car">Марка автомобиля:</label>
                            <input type="text" class="form__field" placeholder="" name="car"
                                   value="{{ $car ?? old('car') }}" required>
                            @error('car')
                            <span class="form__error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form__group">
                            <label class="form__label" for="registration_number">Номер автомобиля:</label>
                            <input type="text" class="form__field" placeholder="" name="registration_number"
                                   value="{{ $driver->registration_number ?? old('registration_number') }}" required>
                            @error('registration_number')
                            <span class="form__error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form__group">
                        <label class="form__label" for="vehicle_registration_certificate">Данные тех паспорта:</label>
                        <input type="text" class="form__field" placeholder="Номер и дата выдачи"
                               name="vehicle_registration_certificate"
                               value="{{ $driver->vehicle_registration_certificate ?? old('vehicle_registration_certificate') }}"
                               required>
                        @error('vehicle_registration_certificate')
                        <span class="form__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form__group">
                        <label class="form__label" for="document_verification">Подтвердить данные:</label>
                        <br>
                        <input class="form__check-input" type="checkbox" name="document_verification"
                               {{ old('document_verification') ? 'checked' : '' }} required>
                        @error('document_verification')
                        <span class="form__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    {{-- <div class="form__group">
                        <label class="form__label" for="personalinfo">Обо мне:</label>
                        <input type="text" class="form__field" placeholder="Краткая информация о водителе"
                            name="personalinfo" value="{{ $profile->personalinfo ?? old('personalinfo') }}">
                    </div> --}}
                    <br>
                    <button type="submit" class="form__button form__button_primary">Ввести</button>
                </form>
            </div>

            <!--Мой вариант-->
            <div class="account__card">
                <h4 id="s4" class="text-primary">Отправить информацию или комментарии о городе и его
                    достопримечательностях</h4>
                <form class="form" method="POST" action="{{ route('account') }}" class="needs-validation"
                      novalidate>
                    @csrf
                    <div class="form__group grid-col-1-2">
                        <div class="form__group">
                            <label class="form__label" for="sel1">Выберите город:</label>
                            {{-- <selectCityAcc></selectCityAcc>
                            <select-city></select-city> --}}
                            <input id="myInput" class="form__field" type="text" name="cityname" placeholder="Город">
                            {{-- <select class="form-control" id="focusedInput" name="cityname">
                                <option>Москва</option>
                                <option>Санкт-Петербург</option>
                                <option>Нижний Новгород</option>
                            </select>
                            <input type="text" class="form__field" class="comment_type" placeholder=""
                                name="commentable_type" required> --}}
                            @error('cityname')
                            <span class="form__error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form__group">
                            <label class="form__label" for="comment_body">Комментарий:</label>
                            <textarea class="form__field" class="comment_body" rows="2" placeholder=""
                                      name="comment_body" required></textarea>
                        </div>
                    </div>
                    <d class="form__group">
                        <label class="form__label" for="uname">Выберите достопримечательность или введите свою:</label>
                        <input type="text" class="form__field" class="comment_type" placeholder=""
                               name="commentable_type" required>
                        @error('uname')
                        <span class="form__error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </d iv>
                    <div class="form__group">
                        <label class="form__label" for="comment_body">Комментарий:</label>
                        <textarea class="form__field" class="comment_body" rows="2" placeholder="" name="comment_body"
                                  required></textarea>
                    </div>
                    <br>
                    <button type="submit" class="form__button form__button_primary">Добавить</button>
                </form>
            </div>

            <!-- Новый вариант -->
            <div class="account__card">
                <h4 id="s4" class="text-primary">Отправить комментарий</h4>
                <form class="form" method="POST" action="{{ route('comments.store') }}"
                      class="needs-validation" novalidate>
                    @csrf
                    <select-relation relation-name="commentable" :relations="{{ json_encode($commentRelations) }}">
                    </select-relation>
                    @error('commentable_type')
                    <p class="block-form__text-error">{{ $message }}</p>
                    @enderror
                    @error('commentable_id')
                    <p class="block-form__text-error">{{ $message }}</p>
                    @enderror
                    <div class="form__group">
                        <label class="form__label" for="comment_body">Комментарий:</label>
                        <textarea class="form__field" class="comment_body" rows="2" placeholder="" name="comment_body"
                                  required></textarea>
                    </div>
                    @error('comment_body')
                    <p class="block-form__text-error">{{ $message }}</p>
                    @enderror
                    <br>
                    <button type="submit" class="form__button form__button_primary">Добавить</button>
                </form>
            </div>

            <div class="account__card">
                <h4 id="s5" class="text-primary">Отзывы обо мне</h4>
                <div class="feedback-block__items container">
                    @foreach ($comments as $comment)
                        <div class="feedback-block__item">
                            <p class="feedback-block__text text">{{ $comment['comment_body'] }}</p>
                            <p class="feedback-block__author">{{ $comment['firstname'] }} {{ $comment['lastname'] }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- <div class="account__card">
                <div class="form__group">
                    <h4 class="text-primary">Полезная информация</h4>
                </div>
            </div> --}}
        </div>
    </main>
@endsection
