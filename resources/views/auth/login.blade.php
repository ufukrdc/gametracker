@extends('layout')

@section('title', 'Giriş Yap')

@section('content')
<div class="form-kutu">
    <h2>Giriş Yap</h2>

    @if ($errors->any())
        <p class="hata">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>Şifre:</label>
        <input type="password" name="password" required>

        <button type="submit">Giriş Yap</button>
    </form>

    <p>Hesabın yok mu? <a href="{{ route('register') }}">Kayıt ol</a></p>
</div>
@endsection
