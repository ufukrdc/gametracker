@extends('layout')

@section('title', 'Oyunlar')

@section('content')
<div class="sayfa">
    <div class="baslik-satir">
        <h1>Oyunlar</h1>
        <div class="sirala">
            <a href="{{ route('games.index') }}" class="{{ $sort !== 'puan' ? 'aktif' : '' }}">En Yeni</a>
            <a href="{{ route('games.index', ['sort' => 'puan']) }}" class="{{ $sort === 'puan' ? 'aktif' : '' }}">En Yüksek Puan</a>
        </div>
    </div>

    <div class="oyun-grid">
        @forelse ($games as $game)
            <a href="{{ route('games.show', $game) }}" class="oyun-kart">
                @if ($game->background_image)
                    <img src="{{ $game->background_image }}" alt="{{ $game->title }}" class="kart-resim">
                @endif
                <div class="kart-icerik">
                    <h3>{{ $game->title }}</h3>
                    <p>{{ $game->genre }}@if($game->genre && $game->platform) · @endif{{ $game->platform }}</p>
                    <small>{{ $game->year }}</small>
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
            <p>Henüz oyun eklenmemiş. <a href="{{ route('rawg.search') }}">RAWG'den ekleyerek</a> başlayabilirsin.</p>
        @endforelse
    </div>
</div>
@endsection
