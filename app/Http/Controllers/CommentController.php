<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Game $game)
    {
        $data = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:10'],
            'body'   => ['required', 'string', 'max:2000'],
        ]);

        $game->comments()->create([
            'user_id' => $request->user()->id,
            'rating'  => $data['rating'],
            'body'    => $data['body'],
        ]);

        return redirect()->route('games.show', $game);
    }
}
