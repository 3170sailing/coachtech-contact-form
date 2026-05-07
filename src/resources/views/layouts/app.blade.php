<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="/">
                FashionablyLate
            </a>

            @guest
                @unless (request()->is('/') || request()->is('confirm'))
                    @if (request()->is('login'))
                        <a class="header__link" href="{{ route('register') }}">register</a>
                    @else
                        <a class="header__link" href="{{ route('login') }}">login</a>
                    @endif
                @endif
            @endguest

            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button class="header__button" type="submit">logout</button>
                </form>
            @endauth
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    @yield('script')
</body>

</html>