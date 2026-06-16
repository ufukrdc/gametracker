<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    protected $fillable = [
        'rawg_id',
        'title',
        'genre',
        'platform',
        'year',
        'description',
        'background_image',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function averageRating(): ?float
    {
        $avg = $this->comments()->avg('rating');

        return $avg ? round($avg, 1) : null;
    }
}
