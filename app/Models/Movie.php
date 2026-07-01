<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'synopsis',
        'director',
        'release_year',
        'duration',
        'poster',
        'genre_id',
    ];

    /**
     * Relasi ke genre film ini.
     */
    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    /**
     * Relasi ke review-review film ini.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Relasi ke watchlist yang memuat film ini.
     */
    public function watchlists(): HasMany
    {
        return $this->hasMany(Watchlist::class);
    }

    /**
     * Hitung rata-rata rating film ini.
     */
    public function averageRating(): float
    {
        return $this->reviews()->avg('rating') ?? 0;
    }
}
