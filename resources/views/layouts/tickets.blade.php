<header>
    <nav>
        <ul>
            <li><a href="{{ route('home') }}"><img src="{{ asset('images/logo.png') }}" alt="Логотип"></a></li>
            <li><a href="#">Афиша</a></li>
            <li><a href="#">Как купить?</a></li>
            <li><a href="#">Правила покупки</a></li>
            <li><a href="#">Возврат билетов</a></li>
        </ul>
        <div>
            <a href="#"><img src="{{ asset('images/cart.png') }}" alt="Корзина"></a>

            @auth
                <!-- Если пользователь вошел -->
                <span>{{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit">Выйти</button>
                </form>
            @else
                <!-- Если пользователь не вошел -->
                <a href="{{ route('login') }}">Вход</a>
                <a href="{{ route('register') }}">Регистрация</a>
            @endauth
        </div>
    </nav>
</header>
