<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionableLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <div>
                <a class="header__logo" href="/">
                    FashionableLate
                </a>
            </div>
            <div class="header-utilities">
                <nav>
                    <ul class="header-nav">
                        <li class="header-nav__item login__link">
                            <a class="header-nav__link" href="/login">login</a>
                        </li>
                        <li class="header-nav__item register__link">
                            <a class="header-nav__link" href="/register">register</a>
                        </li>
                        @if(Auth::check())
                        <li class="header-nav__item">
                            <form class="form" action="/logout" method="post">
                                @csrf
                                <button class="header-nav__button">logout</button>
                            </form>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>