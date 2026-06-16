<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GameTracker')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<nav>
    <a href="{{ route('games.index') }}" class="logo">GameTracker</a>
    <div class="nav-links">
        @auth
            <a href="{{ route('rawg.search') }}">RAWG'den Ekle</a>
            <a href="{{ route('games.create') }}">+ Oyun Ekle</a>
            <a href="{{ route('profile.show') }}">{{ auth()->user()->name }}</a>
            <form method="POST" action="{{ route('logout') }}" class="cikis-form">
                @csrf
                <button type="submit">Çıkış</button>
            </form>
        @else
            <a href="{{ route('login') }}">Giriş Yap</a>
            <a href="{{ route('register') }}">Kayıt Ol</a>
        @endauth
    </div>
</nav>

<main>
    @yield('content')
</main>

</body>
</html>
