<header class="header">
    <a href="{{ route('index') }}">
        <img src="/storage/images/logo.png" alt="logo">
    </a>
    <nav>
        <button class="burger" onclick="this.classList.toggle('burger--active');
        menu.classList.toggle('header__menu--opened')">
            <div class="burger__line"></div>
        </button>
        <ul class="header__menu" id="menu">
            <li class="header__menu-item">
                <a class="header__menu-link" href="{{ route('index') }}">Главная</a>
            </li>

            @guest

                @if (Route::has('login'))
                    <li class="header__menu-item">
                        <a class="header__menu-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

            @else

                <li class="header__menu-item">
                    <a class="header__menu-link" href="{{ route('account') }}">Кабинет</a>
                </li>

                <li class="header__menu-item">
                    <a class="header__menu-link" href="{{ route('trip') }}">Совместные поездки</a>
                </li>

                @if (Auth::user()->is_admin)
                    <li class="header__menu-item">
                        <a class="header__menu-link" href="{{ route('admin.index') }}">Админка</a>
                    </li>
                @endif

                <li class="header__menu-item">
                    <a class="header__menu-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>

            @endguest

        </ul>
    </nav>
</header>
