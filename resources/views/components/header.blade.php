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
            <li class="header__menu_item">
                <a href="{{ route('index') }}" class="header__menu_link">Главная</a>
            </li>
            <li class="header__menu_item">
                <a href="{{ route('admin.index') }}" class="header__menu_link">В админку</a>
            </li>
        </ul>
    </nav>
</header>
