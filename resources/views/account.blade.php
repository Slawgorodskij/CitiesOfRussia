@extends('layouts.main')

@section('title')
    Личный кабинет - @parent
@stop

@section('content')

<link href="{{ asset('css/auth.css') }}" rel="stylesheet">

<div class="container-fluid p-5 text-center bg-white border">
  <h1>Картинка</h1>
  <p>Текст</p>
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
          <a class="nav-link active" href="#s1">Мой статус</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#s2">Стать водителем</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#s2">Стать пасажиром</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#s3">Оставить комментарий</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#s4">Отзывы обо мне</a>
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
<form method="POST" action="{{ route('account') }}" class="needs-validation" novalidate>
@csrf
  <div class="form-group">
    <label for="uname">Ваше имя:</label>
    <input type="text" class="form-control" id="drivername" placeholder="Имя водителя" name="drivername" required>
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
  </div>
  <div class="form-group">
    <label for="pwd">Паспортные данные:</label>
    <input type="password" class="form-control" id="pasport" placeholder="Номер паспорта и дата выдачи" name="pasport" required>
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
  </div>
  <div class="form-group">
    <label for="pwd">Водительское удостоверение:</label>
    <input type="password" class="form-control" id="licence" placeholder="Номер удостоверения и дата выдачи" name="licence" required>
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
  </div>
  <div class="form-group">
    <label for="pwd">Обо мне:</label>
    <input type="password" class="form-control" id="drinfo" placeholder="Краткая информация о водителе" name="drinfo">
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
  </div>
  <div class="form-group form-check">
    <label class="form-check-label">
      <input class="form-check-input" type="checkbox" name="remember" required> Запомнить меня.
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Check this checkbox to continue.</div>
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Ввести</button>
</form>

            </div>
              <div class="col">
                 <h4 id="s2" class="text-primary">Стать попутчиком</h4>
<form method="POST" action="{{ route('account') }}" class="needs-validation" novalidate>
@csrf
  <div class="form-group">
    <label for="uname">Ваше имя:</label>
    <input type="text" class="form-control" id="passname" placeholder="Имя паcсажира" name="passname" required>
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
  </div>
  <div class="form-group">
    <label for="pwd">Паспортные данные:</label>
    <input type="password" class="form-control" id="pasport" placeholder="Номер паспорта и дата выдачи" name="pasport" required>
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
  </div>
  <div class="form-group">
    <label for="pwd">Обо мне:</label>
    <input type="password" class="form-control" id="passinfo" placeholder="Краткая информация о водителе" name="passinfo">
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
  </div>
  <div class="form-group form-check">
    <label class="form-check-label">
      <input class="form-check-input" type="checkbox" name="remember" required> Запомнить меня.
      <div class="valid-feedback">Valid.</div>
      <div class="invalid-feedback">Check this checkbox to continue.</div>
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Ввести</button>
</form>
        </div>
    </div>
</div>

<div class="container p-5 mt-4 bg-white">
    <div class="row">
        <h4 id="s3" class="text-primary">Отправить информацию или комментарии о городе и его достопримечательностях</h4>
<form method="POST" action="{{ route('account') }}" class="needs-validation" novalidate>
@csrf
  <div class="form-group">
    <label for="uname">Ввести название города или достопримечательности:</label>
    <input type="text" class="form-control" id="destname" placeholder="" name="destname" required>
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
  </div>  <div class="form-group">
    <label for="pwd">Комментарий:</label>
    <input type="password" class="form-control" id="citycomment" placeholder="" name="citycomment" required>
    <div class="valid-feedback">Valid.</div>
    <div class="invalid-feedback">Please fill out this field.</div>
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
