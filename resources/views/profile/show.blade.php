@extends('layout')

@section('title', $user->name . ' - Profil')

@section('content')
<div class="sayfa">
    <div class="profil-ust">
        <h1>{{ $user->name }}</h1>
        <p>{{ $user->email }}</p>
        <small>Üyelik tarihi: {{ $user->created_at->format('d.m.Y') }}</small>
    </div>

    <h2 class="bolum-baslik">Eklediğim Oyunlar ({{ $games->count() }})</h2>
    <div class="oyun-grid">
        @forelse ($games as $game)
            <a href="{{ route('games.show', $game) }}" class="oyun-kart">
                @if ($game->background_image)
                    <img src="{{ $game->background_image }}" alt="{{ $game->title }}" class="kart-resim">
                @endif
                <div class="kart-icerik">
                    <h3>{{ $game->title }}</h3>
                    <p>{{ $game->genre }}</p>
                    <div class="kart-puan">
                        @if ($game->comments_avg_rating)
                            ⭐ {{ number_format($game->comments_avg_rating, 1) }}/10
                            <span class="yorum-sayi">({{ $game->comments_count }})</span>
                        @else
                            <span class="puan-yok">Puan yok</span>
                        @endif
                    </div>
                </div>
            </a>
        @empty
            <p>Henüz oyun eklemedin.</p>
        @endforelse
    </div>

    <h2 class="bolum-baslik">Yorumlarım ({{ $comments->count() }})</h2>
    <div class="yorumlar">
        @forelse ($comments as $yorum)
            <div class="yorum-kart">
                <strong><a href="{{ route('games.show', $yorum->game) }}">{{ $yorum->game->title }}</a></strong>
                <span class="puan">⭐ {{ $yorum->rating }}/10</span>
                <p>{{ $yorum->body }}</p>
                <small>{{ $yorum->created_at->diffForHumans() }}</small>
            </div>
        @empty
            <p>Henüz yorum yazmadın.</p>
        @endforelse
    </div>
</div>
@endsection
