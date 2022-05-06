<div class="destination wrapper" style="background-image: url(/storage/images/ad.jpg);">
        <div class="destination__advert">

            @unless (Auth::check())
                <h2>
                    Отправляйтесь в путешествие прямо сейчас! <br>
                    Выбирайте привлекательные города России, комбинируйте их в маршруты, и посетите проверенные достопримечательности в нескучной компании случайных попутчиков!
                </h2>
                <a href='/login' class="destination__advertlink">
                    Только зарегистрируйтесь!
                </a>
                <h2">
                    Счастливых путешествий и новых открытий!
                </h2>
            @else
                <h2>
                    Вы уже с нами!
                </h2>
                <a href='/home' class="destination__advertlink">
                    Выберите маршрут и попутчика прямо сейчас!
                </a>
            @endunless

        </div>
    </div>

