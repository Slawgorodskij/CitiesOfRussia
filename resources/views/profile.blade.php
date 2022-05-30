@extends('layouts.main')
@section('content')

<main>

<div class="account_profile">
<h3>Профиль</h3>
</div>

<div class="container wrapper">
<div class="account_profile_container">
      <img src="/storage/images/face.jpg" class="rounded" alt="Cinque Terre">
      <button type="submit" class="account_profile_button">Загрузить фотографию</button>
</div>
</div>

<div class="container wrapper">
<div class="account_profile_container">
<h4>Изменить данные профиля</h4>  

<form method="POST" action="{{ isset($profile) ? route('account', $profile) : route('profile.store') }}" novalidate>
@csrf

<div class="account_profile_form_h">

<div class="account_profile_form_v">
    <label for="uname">Имя:</label>
    <input type="hidden" name="user_id" value="{{$user->id}}">
    <input name="firstname" type="text" class="account_profile_input" 
            placeholder="" value="{{ $profile->firstname ?? $user ->name }}" required>
 
    <label for="lastname">Фамилия:</label>
    <input type="text" class="account_profile_input" placeholder="" name="lastname" 
    value="{{ $profile->lastname ?? old('lastname') }}" required>   
  
    <label for="patronymic">Отчество:</label>
    <input type="text" class="account_profile_input" placeholder="" name="patronymic" 
    value="{{ $profile->patronymic ?? old('patronymic') }}" required> 
</div>

<div class="account_profile_form_v">
    <label for="phone">Телефон:</label>
    <input type="hidden" name="user_id" value="{{$user->id}}">
    <input name="phone" type="tel" class="account_profile_input"
            placeholder="+(7)123-456-67-89" value="{{ $profile->phone ?? old('phone') }}" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required>
 
    <label for="email">Email:</label>
    <input type="text" class="account_profile_input" placeholder="" name="email" 
    value="{{ $user->email ?? old('$user->email') }}" required>   
  
    <label for="location">Город:</label>
    <input type="text" class="account_profile_input" placeholder="" name="location" 
    value="{{ $profile->location ?? old('location') }}" required> 
</div>
</div>

<div class="account_profile_form_h">
    <p>Дата рождения:</p>

    <input type="date" class="account_profile_input_narrow" name="date_of_birth" 
    value="{{ $profile->date_of_birth ?? old('date_of_birth') }}" required>

    <p>О себе:</p>
    <textarea type="text" class="account_profile_input_wide" name="personalinfo" 
    value="{{ $profile->personalinfo ?? old('personalinfo') }}"></textarea>
</div>

<br>
  <button type="submit" class="account_profile_button">Сохранить изменения</button>
</form>
   
</div>
</div>   

</main>

@endsection