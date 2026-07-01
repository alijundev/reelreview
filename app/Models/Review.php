<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'movie_id',
        'rating',
        'review_text',
        'is_spoiler',
    ];

    protected $casts = [
        'is_spoiler' => 'boolean',
        'rating'     => 'integer',
    ];

    /**
     * Relasi ke user penulis review ini.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke film yang diulas.
     */
    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }
}
