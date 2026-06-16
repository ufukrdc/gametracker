<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RawgController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GameController::class, 'index'])->name('games.index');
Route::get('/oyun/{game}', [GameController::class, 'show'])->name('games.show');

Route::get('/kayit', [AuthController::class, 'showRegister'])->name('register');
Route::post('/kayit', [AuthController::class, 'register']);
Route::get('/giris', [AuthController::class, 'showLogin'])->name('login');
Route::post('/giris', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::post('/cikis', [AuthController::class, 'logout'])->name('logout');

    Route::get('/oyun-ekle', [GameController::class, 'create'])->name('games.create');
    Route::post('/oyun-ekle', [GameController::class, 'store'])->name('games.store');
    Route::delete('/oyun/{game}', [GameController::class, 'destroy'])->name('games.destroy');

    Route::post('/oyun/{game}/yorum', [CommentController::class, 'store'])->name('comments.store');

    Route::get('/rawg', [RawgController::class, 'search'])->name('rawg.search');
    Route::post('/rawg/ekle', [RawgController::class, 'import'])->name('rawg.import');

    Route::get('/profil', [ProfileController::class, 'show'])->name('profile.show');
});
