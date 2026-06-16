@extends('layout')

@section('title', 'Kayıt Ol')

@section('content')
<div class="form-kutu">
    <h2>Kayıt Ol</h2>

    @if ($errors->any())
        <p class="hata">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label>Kullanıcı Adı:</label>
        <input type="text" name="name" value="{{ old('name') }}" required>

        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label>Şifre:</label>
        <input type="password" name="password" required>

        <label>Şifre (Tekrar):</label>
        <input type="password" name="password_confirmation" required>

        <button type="submit">Kayıt Ol</button>
    </form>

    <p>Zaten hesabın var mı? <a href="{{ route('login') }}">Giriş yap</a></p>
</div>
@endsection
