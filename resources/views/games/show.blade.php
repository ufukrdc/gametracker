@extends('layout')

@section('title', $game->title)

@section('content')
<div class="sayfa">
    <div class="oyun-detay">
        @if ($game->background_image)
            <img src="{{ $game->background_image }}" alt="{{ $game->title }}" class="detay-resim">
        @endif

        <h1>{{ $game->title }}</h1>
        <p><strong>Tür:</strong> {{ $game->genre ?: '—' }}</p>
        <p><strong>Platform:</strong> {{ $game->platform ?: '—' }}</p>
        <p><strong>Yıl:</strong> {{ $game->year ?: '—' }}</p>
        @if ($game->averageRating())
            <p><strong>Ortalama Puan:</strong> ⭐ {{ $game->averageRating() }}/10</p>
        @endif
        <p class="aciklama">{{ $game->description ?: 'Açıklama yok.' }}</p>

        @auth
            @if ($game->user_id === auth()->id())
                <form method="POST" action="{{ route('games.destroy', $game) }}"
                      onsubmit="return confirm('Bu oyunu silmek istediğine emin misin?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="sil-btn">Oyunu Sil</button>
                </form>
            @endif
        @endauth
    </div>

    @auth
        <div class="yorum-form">
            <h3>Yorum Yaz</h3>

            @if ($errors->any())
                <p class="hata">{{ $errors->first() }}</p>
            @endif

            <form method="POST" action="{{ route('comments.store', $game) }}">
                @csrf
                <label>Puan (1-10):</label>
                <input type="number" name="rating" min="1" max="10" value="{{ old('rating') }}" required>

                <label>Yorumun:</label>
                <textarea name="body" rows="4" required>{{ old('body') }}</textarea>

                <button type="submit">Gönder</button>
            </form>
        </div>
    @else
        <p><a href="{{ route('login') }}">Giriş yaparak</a> yorum yazabilirsiniz.</p>
    @endauth

    <div class="yorumlar">
        <h3>Yorumlar ({{ $game->comments->count() }})</h3>

        @forelse ($game->comments as $yorum)
            <div class="yorum-kart">
                <strong>{{ $yorum->user->name }}</strong>
                <span class="puan">⭐ {{ $yorum->rating }}/10</span>
                <p>{{ $yorum->body }}</p>
                <small>{{ $yorum->created_at->diffForHumans() }}</small>
            </div>
        @empty
            <p>Henüz yorum yok.</p>
        @endforelse
    </div>
</div>
@endsection
