<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Project04: @yield('title')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/media.css') }}">
</head>
<body>
<div class="main-wrapper">
    <header class="main-header">
        <div class="logotype-container"><a href="/" class="logotype-link"><img src="{{ asset('../img/logo.png') }}"
                                                                               alt="Логотип"></a>
        </div>
        <nav class="main-navigation">
            @guest
                <h1>Hello, guest!</h1>
            @else
                @if(Auth::user()->level == 0)
                    <ul class="nav-list">
                        <li class="nav-list__item">
                            <a href="/" class="nav-list__item__link">Главная</a>
                        </li>
                        <li class="nav-list__item">
                            <a href="{{ route('order.list') }}" class="nav-list__item__link">Заказы</a>
                        </li>
                        <li class="nav-list__item">
                            <a href="{{ route('logout') }}" class="nav-list__item__link">Выход</a>
                        </li>
                    </ul>
                @else
                    <ul class="nav-list">
                        <li class="nav-list__item">
                            <a href="{{ route('category') }}" class="nav-list__item__link">Категории</a>
                        </li>
                        <li class="nav-list__item">
                            <a href="{{ route('product') }}" class="nav-list__item__link">Товары</a>
                        </li>
                        <li class="nav-list__item">
                            <a href="{{ route('admin.order.list') }}" class="nav-list__item__link">Заказы</a>
                        </li>
                        <li class="nav-list__item">
                            <a href="{{ route('logout') }}" class="nav-list__item__link">Выход</a>
                        </li>
                    </ul>
                @endif
            @endguest
        </nav>
        <div class="header-contact">
            <div class="header-contact__phone"><a href="#" class="header-contact__phone-link">Телефон: 33-333-33</a>
            </div>
        </div>
        <div class="header-container">
            <div class="authorization-block">
                @guest
                    <a href="{{ route('login') }}" class="authorization-block__link">Login</a>
                    <a href="{{ route('register') }}" class="authorization-block__link">Register</a>
                @else
                    <a href="{{ route('home') }}">{{ Auth::user()->name }}</a>
                    @if(Auth::user()->level == 0)
                        / User
                    @else
                        / Admin
                    @endif
                @endguest
            </div>
        </div>
    </header>
    <div class="middle">
        <div class="sidebar">
            <div class="sidebar-item">
                <div class="sidebar-item__title">Категории</div>
                <div class="sidebar-item__content">
                    @foreach(\App\Category::all('id', 'name') as $category)
                        <li class="sidebar-category__item">
                            <a href="/category/{{ $category->id }}"
                               class="sidebar-category__item__link">{{ $category->name }}
                                ({{$category->products->count()}})</a>
                        </li>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="main-content">
            <div class="content-middle">
                <div class="content-head__container">
                    <div class="content-head__title-wrap">
                        <div class="content-head__title-wrap__title bcg-title">
                            @yield('header')
                        </div>
                    </div>
                    <div class="content-head__search-block">
                        <div class="search-container">
                            <form class="search-container__form">
                                <input type="text" class="search-container__form__input">
                                <button class="search-container__form__btn">search</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="content-main__container">
                    @yield('content')
                </div>
            </div>
            <div class="content-bottom"></div>
        </div>
    </div>
    <footer class="footer">
        <div class="footer__footer-content">
            <div class="footer__footer-content__main-content">
                &copy; ZolotukhinVM @php echo date('Y') @endphp / Make with &#10084;
            </div>
        </div>
    </footer>
</div>
<script src="{{ asset('../js/main.js') }}"></script>
</body>
</html>
