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
                    <a class="navbar__link" href="#">Мои поездки</a>
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
                </div>
                <div>
                    <div>
                        @if(isset($dataCurrentTrips[0]))
                        <h2 class="title">Действующие поездки</h2>
                        @foreach($dataCurrentTrips as $trip)
                            <div class="comment-block">
                                <p><span>{{$trip['departureCity']}}</span></p>
                                <p>Город прибытия: <span>{{$trip['cityOfArrival']}}</span></p>
                                <p>Период: с <span> {{$trip['start']}}</span> - по
                                    <span>{{$trip['finish']}}</span></p>
                                @foreach($trip['roles'] as $role)
                                    <p>Роль: {{$role}} </p>
                                @endforeach
                            </div>
                        @endforeach
                        @else
                            <h2 class="title">У вас незапланированно поездок</h2>
                        @endif
                    </div>

                    <div>
                        @if(isset($dataArchiveTrips[0]))
                            <h2 class="title">Архив поездок</h2>

                            <div class="archive-block">
                                @foreach($dataArchiveTrips as $trip)
                                    <div class="archive-block__item">
                                        <p>{{$trip['departureCity']}} - {{$trip['cityOfArrival']}}</p>
                                        <p>с <span> {{$trip['start']}}</span> - по
                                            <span>{{$trip['finish']}}</span></p>
                                        @foreach($trip['roles'] as $role)
                                            <p>Роль: {{$role}} </p>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <h2 class="title">У вас нет поездок в архиве</h2>
                        @endif
                    </div>
                </div>


            </div>

        </div>
    </main>
@endsection

