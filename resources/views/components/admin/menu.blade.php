<nav>
    <ul class="admin-menu">
        <li class="admin-menu__item">
            <a class="admin-menu__link @if(request()->routeIs('admin.index')) admin-menu__link--active @endif"
                href="{{ route('admin.index') }}">
                Панель управления
            </a>
        </li>
        <li class="admin-menu__item">
            <a class="admin-menu__link @if(request()->routeIs('admin.cities.*')) admin-menu__link--active @endif"
                href="{{ route('admin.cities.index') }}">
                Города
            </a>
        </li>
        <li class="admin-menu__item">
            <a class="admin-menu__link @if(request()->routeIs('admin.sights.*')) admin-menu__link--active @endif"
                href="{{ route('admin.sights.index') }}">
                Достопримечательности
            </a>
        </li>
        <li class="admin-menu__item">
            <a class="admin-menu__link @if(request()->routeIs('admin.articles.*')) admin-menu__link--active @endif"
                href="{{ route('admin.articles.index') }}">
                Статьи
            </a>
        </li>
        <li class="admin-menu__item">
            <a class="admin-menu__link @if(request()->routeIs('admin.users.*')) admin-menu__link--active @endif"
                href="{{ route('admin.users.index') }}">
                Пользователи
            </a>
        </li>
    </ul>
</nav>
