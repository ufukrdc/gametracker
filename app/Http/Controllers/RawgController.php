<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Services\RawgService;
use Illuminate\Http\Request;

class RawgController extends Controller
{
    public function __construct(private RawgService $rawg)
    {
    }

    public function search(Request $request)
    {
        $query   = trim((string) $request->query('q', ''));
        $results = $query !== '' ? $this->rawg->search($query) : [];
        $hata    = $this->rawg->lastError;

        $eklenmis = Game::whereNotNull('rawg_id')->pluck('id', 'rawg_id');

        return view('rawg.search', compact('query', 'results', 'eklenmis', 'hata'));
    }

    public function import(Request $request)
    {
        $data = $request->validate([
            'rawg_id' => ['required', 'integer'],
        ]);

        $mevcut = Game::where('rawg_id', $data['rawg_id'])->first();
        if ($mevcut) {
            return redirect()->route('games.show', $mevcut);
        }

        $detay = $this->rawg->find($data['rawg_id']);
        if (! $detay) {
            return back()->withErrors([
                'rawg' => 'Oyun RAWG\'den getirilemedi. RAWG_API_KEY degerini kontrol et.',
            ]);
        }

        $game = Game::create([
            'rawg_id'          => $detay['id'],
            'title'            => $detay['name'] ?? 'Bilinmeyen Oyun',
            'genre'            => collect($detay['genres'] ?? [])->pluck('name')->implode(', ') ?: null,
            'platform'         => collect($detay['platforms'] ?? [])->pluck('platform.name')->implode(', ') ?: null,
            'year'             => ! empty($detay['released']) ? (int) substr((string) $detay['released'], 0, 4) : null,
            'description'      => $detay['description_raw'] ?? null,
            'background_image' => $detay['background_image'] ?? null,
            'user_id'          => $request->user()->id,
        ]);

        return redirect()->route('games.show', $game);
    }
}
