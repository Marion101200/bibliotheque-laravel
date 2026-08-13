<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tome extends Model
{
    protected $fillable = [
        'manga_id',
        'numero',
        'disponible',
    ];

    protected $casts = [
        'disponible' => 'boolean',
    ];

    public function manga(): BelongsTo
    {
        return $this->belongsTo(Manga::class);
    }
}