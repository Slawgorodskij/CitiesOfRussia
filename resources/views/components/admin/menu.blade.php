<nav>
    <ul class="admin-menu">
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
            <a class="admin-menu__link @if(request()->routeIs('admin.images.*')) admin-menu__link--active @endif"
                href="{{ route('admin.images.index') }}">
                Фото
            </a>
        </li>
        <li class="admin-menu__item">
            <a class="admin-menu__link @if(request()->routeIs('admin.users.*')) admin-menu__link--active @endif"
                href="{{ route('admin.users.index') }}">
                Пользователи
            </a>
        </li>
        <li class="admin-menu__item">
            <a class="admin-menu__link @if(request()->routeIs('admin.comments.*')) admin-menu__link--active @endif"
                href="{{ route('admin.comments.index') }}">
                Комментарии
            </a>
        </li>
    </ul>
</nav>
