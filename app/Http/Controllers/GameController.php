<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->query('sort');

        $games = Game::query()
            ->withCount('comments')
            ->withAvg('comments', 'rating')
            ->latest()
            ->get();

        if ($sort === 'puan') {
            $games = $games->sortByDesc('comments_avg_rating')->values();
        }

        return view('games.index', compact('games', 'sort'));
    }

    public function show(Game $game)
    {
        $game->load([
            'user',
            'comments' => fn ($q) => $q->latest()->with('user'),
        ]);

        return view('games.show', compact('game'));
    }

    public function create()
    {
        return view('games.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => ['required', 'string', 'max:200'],
            'genre'       => ['nullable', 'string', 'max:100'],
            'platform'    => ['nullable', 'string', 'max:100'],
            'year'        => ['nullable', 'integer', 'min:1970', 'max:2100'],
            'description' => ['nullable', 'string'],
        ]);

        $data['user_id'] = $request->user()->id;

        $game = Game::create($data);

        return redirect()->route('games.show', $game);
    }

    public function destroy(Request $request, Game $game)
    {
        abort_unless($game->user_id === $request->user()->id, 403);

        $game->delete();

        return redirect()->route('games.index');
    }
}
