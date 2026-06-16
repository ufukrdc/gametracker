@extends('layout')

@section('title', "RAWG'den Oyun Ara")

@section('content')
<div class="sayfa">
    <h1>RAWG'den Oyun Ara</h1>

    @if ($errors->any())
        <p class="hata">{{ $errors->first() }}</p>
    @endif

    @if (!empty($hata))
        <p class="hata">{{ $hata }}</p>
    @endif

    <form method="GET" action="{{ route('rawg.search') }}" class="arama-form">
        <input type="text" name="q" value="{{ $query }}" placeholder="Oyun adı: Witcher, Elden Ring, GTA..." required>
        <button type="submit">Ara</button>
    </form>

    @if ($query !== '' && count($results) === 0 && empty($hata))
        <p>"{{ $query }}" için sonuç bulunamadı.</p>
    @endif

    <div class="oyun-grid">
        @foreach ($results as $r)
            <div class="oyun-kart">
                @if (!empty($r['background_image']))
                    <img src="{{ $r['background_image'] }}" alt="{{ $r['name'] }}" class="kart-resim">
                @endif
                <div class="kart-icerik">
                    <h3>{{ $r['name'] }}</h3>
                    <small>{{ !empty($r['released']) ? substr($r['released'], 0, 4) : '—' }}</small>

                    <div class="kart-aksiyon">
                        @if ($eklenmis->has($r['id']))
                            <a href="{{ route('games.show', $eklenmis[$r['id']]) }}" class="eklendi">✓ Eklendi → Gör</a>
                        @else
                            <form method="POST" action="{{ route('rawg.import') }}">
                                @csrf
                                <input type="hidden" name="rawg_id" value="{{ $r['id'] }}">
                                <button type="submit">+ Ekle</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
