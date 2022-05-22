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
        <a class="nav-link active" href="#">Профиль</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Мои города</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Мои поездки</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Мои попутчики</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Выход из кабинета</a>
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
      <p>Информация обо мне</p>
      <h3 class="mt-4">Переход по странице</h3>
      <p>Lorem ipsum dolor sit ame.</p>

      <ul class="nav nav-pills flex-column">
      <li class="nav-item">
          <a class="nav-link" href="#s1">Мой статус</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#s2">Стать водителем</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#s3">Стать попутчиком</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#s4">Оставить комментарий</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#s5">Отзывы обо мне</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Полезная информация</a>
        </li>
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
      <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>

      @foreach ($sightComments as $key => $array)
          <h2 class="mt-5 text-primary">Достопримечательность<br>{{$array['sight']->name}}</h2>
          @foreach($array['comments'] as $comment)
              <h5>{{$comment->created_at}}</h5>
              <p>"{{$comment->comment_body}}"</p>
          @endforeach
      @endforeach

      <p>Some text..</p>
      <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
    </div>
  </div>
    </div>

<div class="container p-5 mt-4 bg-white">
    <div class="row">
        <h4 id="s1" class="text-primary">Мой статус</h4>
    </div>
</div>

<div class="container p-5 mt-4 bg-white">
    <div class="row">
        <h4 class="text-primary">Информация о предложениях и возможностях </h4>
    </div>
</div>

<div class="container p-5 mt-4 bg-white">
    <div class="row">
    <div class="col">
            <h4 id="s2" class="text-primary">Стать водителем</h4>
            <p>Введите необходимые данные о водителе:</p>
<form method="POST" action="{{ route('account') }}" class="needs-validation" novalidate>
@csrf
<div class="row">
  <div class="form-group col">
    <label for="uname">Имя:</label>
    <input type="text" class="form-control" class="firstname" placeholder="" name="firstname" required>
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
  </div>
  <div class="form-group col">
    <label for="uname">Фамилия:</label>
    <input type="text" class="form-control" class="lastname" placeholder="" name="lastname" required>
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
  </div>
  <div class="form-group col">
    <label for="uname">Отчество:</label>
    <input type="text" class="form-control" class="patronymic" placeholder="" name="patronymic" required>
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
  </div>
</div>

  <div class="form-group">
    <label for="pwd">Водительское удостоверение:</label>
    <input type="password" class="form-control" id="licence" placeholder="Номер и дата выдачи" name="driving_license" required>
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
  </div>
<div class="row">
   <div class="form-group col">
    <label for="pwd">Марка автомобиля:</label>
    <input type="password" class="form-control" id="car" placeholder="" name="car" required>
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
  </div>
   <div class="form-group col">
    <label for="pwd">Номер автомобиля:</label>
    <input type="password" class="form-control" id="reg_number" placeholder="" name="registration_number" required>
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
  </div>
</div>
  <div class="form-group">
    <label for="pwd">Данные тех паспорта:</label>
    <input type="password" class="form-control" id="sertificate" placeholder="Номер и дата выдачи" name="vechile_registration_sertificate" required>
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
  </div>
  <div class="form-group">
    <label for="pwd">Обо мне:</label>
    <input type="password" class="form-control" id="driverinfo" placeholder="Краткая информация о водителе" name="driverinfo">
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
  </div>
  <div class="form-group form-check">
    <label class="form-check-label">
      <input class="form-check-input" type="checkbox" name="remember" required> Запомнить меня
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Check this checkbox to continue.</div>
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Ввести</button>
</form>

        </div>
        </div>
</div>

@if(isset($user_id))
        echo $user_id;
@endif

<div class="container p-5 mt-4 bg-white">
    <div class="row">
    <div class="col">
                 <h4 id="s3" class="text-primary">Стать попутчиком</h4>
                  <p>Введите необходимые данные о пассажире:</p>
<form method="POST"
action="{{ isset($user_id) ? route('account', $user_id) : route('profile') }}"
class="needs-validation" novalidate>
@csrf
<div class="row">
  <div class="form-group col">
    <label for="uname">Имя:</label>

    <input type="hidden" name="user_id" value="{{$user->id}}">
    <input name="firstname" type="text" class="form-control block-form__input @error('firstname') block-form__input_error @enderror"
            placeholder="" value="{{ $profile->firstname ?? old('firstname') }}" required/>

  </div>
  <div class="form-group col">
    <label for="uname">Фамилия:</label>
    <input type="text" class="form-control" class="lastname" placeholder="" name="lastname" required>
  </div>

  <div class="form-group col">
    <label for="uname">Отчество:</label>
    <input type="text" class="form-control" class="patronymic" placeholder="" name="patronymic">
  </div>

</div>
<div class="form-group">
    <label for="pwd">Обо мне:</label>
    <input type="password" class="form-control" id="passinfo" placeholder="Краткая информация о пассажире" name="passinfo">

  </div>
  <div class="form-group form-check">
    <label class="form-check-label">
      <input class="form-check-input" type="checkbox" name="remember" required> Запомнить меня

    </label>
  </div>
  <button type="submit" class="btn btn-primary">Ввести</button>
</form>
        </div>
    </div>
</div>

@php
//dump();
@endphp
<div class="container p-5 mt-4 bg-white">
    <div class="row">
        <h4 id="s4" class="text-primary">Отправить информацию или комментарии о городе и его достопримечательностях</h4>

<form method="POST" action="{{ route('account') }}" class="needs-validation" novalidate>
@csrf
<select-relation relation-name="commentable" selected-type="{{ request()->get('commentable_type') }}"
    selected-id="{{ request()->get('commentable_id') }}" :relations="{{ json_encode($commentRelations) }}">
</select-relation>
<div class="row">
  <div class="col-sm-4">
    <label for="sel1">Выберите город:</label>

    <selectCityAcc></selectCityAcc>
<!--    <select-city></select-city>

 <input id="myInput" class="form-control" type="text" name="cityname" placeholder="Город">
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

<div class="container p-5 mt-4 bg-white">
    <div class="row">
        <h4 id="s4" class="text-primary">Отзывы о пользователе</h4>

            <div class="feedback-block__items container">

                <div class="feedback-block__item">
                    <p class="feedback-block__text text">
                        <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus architecto aspernatur atque deleniti dolore doloribus eum expedita hic incidunt laborum, minus, omnis possimus quam quos repellendus sequi tempore ut, voluptatibus!</span>
                    </p>
                    <p class="feedback-block__author">Иван Иванов</p>
                    <p class="feedback-block__text text">
                        <span>Consectetur corporis cumque debitis dolorum earum eius, eligendi eos esse eum fugit illo in incidunt ipsum maxime minus nisi nostrum obcaecati quaerat quia, sed sit sunt totam vel? Ipsa, porro?</span>
                    </p>
                    <p class="feedback-block__author">Иван Иванов</p>
                </div>
                </div>

            </div>
    </div>
</div>

<div class="container p-5 mt-4 bg-white">
    <div class="row">
        <h4 class="text-primary">Полезная информация</h4>
    </div>
</div>

</div>

@endsection
