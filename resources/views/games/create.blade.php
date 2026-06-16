@extends('layout')

@section('title', 'Oyun Ekle')

@section('content')
<div class="form-kutu">
    <h2>Yeni Oyun Ekle</h2>

    @if ($errors->any())
        <p class="hata">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="{{ route('games.store') }}">
        @csrf

        <label>Oyun Adı:</label>
        <input type="text" name="title" value="{{ old('title') }}" required>

        <label>Tür:</label>
        <input type="text" name="genre" value="{{ old('genre') }}" placeholder="RPG, FPS, Spor...">

        <label>Platform:</label>
        <input type="text" name="platform" value="{{ old('platform') }}" placeholder="PC, PS5, Xbox...">

        <label>Çıkış Yılı:</label>
        <input type="number" name="year" value="{{ old('year') }}" placeholder="2024">

        <label>Açıklama:</label>
        <textarea name="description" rows="5">{{ old('description') }}</textarea>

        <button type="submit">Ekle</button>
    </form>
</div>
@endsection
