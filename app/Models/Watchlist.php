<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Watchlist extends Model
{
    protected $fillable = [
        'user_id',
        'movie_id',
    ];

    /**
     * Relasi ke user pemilik watchlist ini.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke film dalam watchlist ini.
     */
    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }
}
