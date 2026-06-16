<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();

        $games = $user->games()
            ->withCount('comments')
            ->withAvg('comments', 'rating')
            ->latest()
            ->get();

        $comments = $user->comments()
            ->with('game')
            ->latest()
            ->get();

        return view('profile.show', compact('user', 'games', 'comments'));
    }
}
