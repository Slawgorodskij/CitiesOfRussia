@extends('layouts.auth')

@section('content')

<link href="{{ asset('css/app.css') }}" rel="stylesheet"> {{-- костыль --}}

<div class="container-fluid p-3 text-center bg-white border" style="background-image: url(/storage/images/road.jpg); background-size: cover;">
<h3 class="text-white-50">Добро пожаловать!</h3>
</div>

<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
  <div class="container">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link active" href="/account/profile">Профиль</a>
      </li>
<!--
      <li class="nav-item">
        <a class="nav-link" href="#">Мои города</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Мои поездки</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Мои попутчики</a>
      </li>
-->
      <li class="nav-item">
        <a class="nav-link" href="/">Вернуться на главную</a>
      </li>
    </ul>
  </div>
</nav>

<div class="container">
<div class="row justify-content-center">

    <div class="container p-5 mt-4 bg-white">
  <div class="row">
    <div class="col-sm-4">
      <img src="/storage/images/face.jpg" class="rounded" alt="Cinque Terre">
      <h2>{{$user->name}}</h2>
      <h5>{{$user->email}}</h5>

      <h3 class="mt-4">Переход по странице</h3>


      <ul class="nav nav-pills flex-column">
      <li class="nav-item">
          <a class="nav-link" href="#s1">Мой статус</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#s2">Стать попутчиком</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#s3">Стать водителем</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#s4">Оставить комментарий</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#s5">Отзывы обо мне</a>
        </li>
<!--
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Полезная информация</a>
        </li>
-->
      </ul>

      <hr class="d-sm-none">
    </div>

    <div class="col-sm-8">
      @foreach ($cityComments as $key => $array)
          <h2 class="text-primary">Город {{$array['city']->name}}</h2>
          @foreach($array['comments'] as $comment)
              <h5>Комментарий от {{$comment->created_at}}</h5>
              <p>"{{$comment->comment_body}}"</p>
          @endforeach
      @endforeach

      <p>Some text..</p>


      @foreach ($sightComments as $key => $array)
          <h2 class="mt-5 text-primary">Достопримечательность<br>{{$array['sight']->name}}</h2>
          @foreach($array['comments'] as $comment)
              <h5>{{$comment->created_at}}</h5>
              <p>"{{$comment->comment_body}}"</p>
          @endforeach
      @endforeach

      <p>Some text..</p>

    </div>
  </div>
    </div>

<div class="container p-5 mt-4 bg-white">
    <div class="row">
        <h4 id="s1" class="text-primary">Мой статус: </h4>
        @if($carinfo)
        <p>Водитель</p>
        <p>Автомобиль <span style="font-weight:bold">{{$carinfo->car}}</span> госномер <span style="font-weight:bold">{{$carinfo->registration_number}}</span></p>
        @endif

    </div>
</div>
<!--
<div class="container p-5 mt-4 bg-white">
    <div class="row">
        <h4 class="text-primary">Информация о предложениях и возможностях </h4>
    </div>
</div>
-->
<div class="container p-5 mt-4 bg-white">
    <div class="row">
    <div class="col">
                 <h4 id="s2" class="text-primary">Стать попутчиком</h4>
                  <p>Введите необходимые данные:</p>
<form method="POST"
action="{{ isset($profile) ? route('account', $profile) : route('profile.store') }}" class="needs-validation" novalidate>
@csrf
<div class="row">
  <div class="form-group col">
    <label for="uname">Имя:</label>

    <input type="hidden" name="user_id" value="{{$user->id}}">

    <input type="text" class="form-control" class="firstname" placeholder="" name="firstname"
    value="{{ $profile->firstname ?? old('firstname') }}" required>

  </div>
  <div class="form-group col">
    <label for="lastname">Фамилия:</label>
    <input type="text" class="form-control" class="lastname" placeholder="" name="lastname"
    value="{{ $profile->lastname ?? old('lastname') }}" required>
  </div>

  <div class="form-group col">
    <label for="patronymic">Отчество:</label>
    <input type="text" class="form-control" class="patronymic" placeholder="" name="patronymic"
    value="{{ $profile->patronymic ?? old('patronymic') }}" required>
  </div>

</div>
<div class="row">
<div class="form-group col-3">
    <label for="date_of_birth">Дата рождения:</label>
    <input type="date" class="form-control" id="date_of_birth" placeholder="Краткая информация о пассажире" name="date_of_birth"
    value="{{ $profile->date_of_birth ?? old('date_of_birth') }}" required>

  </div>
<div class="form-group col">
    <label for="personalinfo">Обо мне:</label>
    <input type="text" class="form-control" id="personalinfo" placeholder="Краткая информация обо мне, как пассажире" name="personalinfo"
    value="{{ $profile->personalinfo ?? old('personalinfo') }}">

  </div>
</div>
<br>
  <button type="submit" class="btn btn-primary">Ввести</button>
</form>
        </div>
    </div>
</div>


<div class="container p-5 mt-4 bg-white">
    <div class="row">
    <div class="col">
            <h4 id="s3" class="text-primary">Стать водителем</h4>
            <p>Введите необходимые данные об автомобиле:</p>
<form method="POST"
action="{{ isset($driver) ? route('account', $driver) : route('driver.store') }}" class="needs-validation" novalidate>
@csrf
<div class="row">


</div>

  <div class="form-group">
    <label for="driving_license">Водительское удостоверение:</label>
    <input type="text" class="form-control" placeholder="Номер и дата выдачи" name="driving_license"
    value="{{ $driver->driving_license ?? old('driving_license') }}"required>
    <div class="valid-feedback"></div>
    <div class="invalid-feedback">Заполните поле</div>
  </div>
<div class="row">
   <div class="form-group col">
    <label for="car">Марка автомобиля:</label>
    <input type="text" class="form-control" placeholder="" name="car" value="{{ $car ?? old('car') }}" required>
    <div class="valid-feedback"></div>
    <div class="invalid-feedback">Заполните поле</div>
  </div>
   <div class="form-group col">
    <label for="registration_number">Номер автомобиля:</label>
    <input type="text" class="form-control" placeholder="" name="registration_number"
    value="{{ $driver->registration_number ?? old('registration_number') }}" required>
    <div class="valid-feedback"></div>
    <div class="invalid-feedback">Заполните поле</div>
  </div>
</div>
  <div class="form-group">
    <label for="vehicle_registration_certificate">Данные тех паспорта:</label>
    <input type="text" class="form-control" placeholder="Номер и дата выдачи" name="vehicle_registration_certificate"
    value="{{ $driver->vehicle_registration_certificate ?? old('vehicle_registration_certificate') }}" required>
    <div class="valid-feedback"></div>
    <div class="invalid-feedback">Заполните поле</div>
  </div>
  <div class="form-group">
    <label for="document_verification">Подтвердить данные:</label>
    <br>
    <input class="form-check-input" type="checkbox" name="document_verification" {{ old('document_verification') ? 'checked' : '' }} required>
    <div class="valid-feedback"></div>
    <div class="invalid-feedback">Заполните поле</div>
  </div>
  <!--
  <div class="form-group">
    <label for="personalinfo">Обо мне:</label>
    <input type="text" class="form-control" placeholder="Краткая информация о водителе" name="personalinfo"
    value="{{ $profile->personalinfo ?? old('personalinfo') }}">
  </div>
-->
  <button type="submit" class="btn btn-primary">Ввести</button>
</form>

        </div>
        </div>
</div>

<!--Мой вариант-->

<div class="container p-5 mt-4 bg-white">
    <div class="row">
        <h4 id="s4" class="text-primary">Отправить информацию или комментарии о городе и его достопримечательностях</h4>

<form method="POST" action="{{ route('account') }}" class="needs-validation" novalidate>
@csrf

<div class="row">
  <div class="col-sm-4">
    <label for="sel1">Выберите город:</label>
<!--
    <selectCityAcc></selectCityAcc>
    <select-city></select-city>
-->
 <input id="myInput" class="form-control" type="text" name="cityname" placeholder="Город">
 <!--
     <select class="form-control" id="focusedInput" name="cityname">
        <option>Москва</option>
        <option>Санкт-Петербург</option>
        <option>Нижний Новгород</option>
      </select>
  <input type="text" class="form-control" class="comment_type" placeholder="" name="commentable_type" required>
-->
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
  </div>
  <div class="col">

  <div class="form-group">
    <label for="comment_body">Комментарий:</label>
    <textarea class="form-control" class="comment_body" rows="2" placeholder="" name="comment_body" required></textarea>
  </div>
    </div>
</div>
  <div class="form-group">
    <label for="uname">Выберите достопримечательность или введите свою:</label>
   <input type="text" class="form-control" class="comment_type" placeholder="" name="commentable_type" required>
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
  </div>
  <div class="form-group">
    <label for="comment_body">Комментарий:</label>
     <textarea class="form-control" class="comment_body" rows="2" placeholder="" name="comment_body" required></textarea>
  </div>
<br>
  <button type="submit" class="btn btn-primary">Добавить</button>
</form>
    </div>
</div>

<!-- Новый вариант -->

<div class="container p-5 mt-4 bg-white">
  <h4 id="s4" class="text-primary">Отправить комментарий</h4>
  <form method="POST" action="{{ route('comments.store') }}" class="needs-validation" novalidate>
    @csrf

    <select-relation relation-name="commentable" :relations="{{ json_encode($commentRelations) }}">
    </select-relation>

    @error('commentable_type')
    <p class="block-form__text-error">{{ $message }}</p>
    @enderror

    @error('commentable_id')
    <p class="block-form__text-error">{{ $message }}</p>
    @enderror

    <div class="col">
      <div class="form-group">
        <label for="comment_body">Комментарий:</label>
        <textarea class="form-control" class="comment_body" rows="2" placeholder="" name="comment_body"
          required></textarea>
      </div>
    </div>

    @error('comment_body')
    <p class="block-form__text-error">{{ $message }}</p>
    @enderror

    <button type="submit" class="btn btn-primary">Добавить</button>
  </form>
</div>


<div class="container p-5 mt-4 bg-white">
    <div class="row">
        <h4 id="s5" class="text-primary">Отзывы обо мне</h4>

            <div class="feedback-block__items container">
                    @foreach($comments as $comment)
                        <div class="feedback-block__item">
                            <p class="feedback-block__text text">{{$comment['comment_body']}}</p>
                <!--        <p class="feedback-block__author">{{$comment['firstname']}} {{$comment['lastname']}}</p> -->
                        </div>
                    @endforeach


                </div>
            </div>

            </div>
    </div>

<!--
<div class="container p-5 mt-4 bg-white">
    <div class="row">
        <h4 class="text-primary">Полезная информация</h4>
    </div>
</div>

-->
</div>
</div>
<!--
</div>
-->
@endsection
