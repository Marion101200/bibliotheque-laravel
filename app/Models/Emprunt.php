<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Manga;

class Emprunt extends Model
{
    protected $fillable = [
        'user_id',
        'manga_id',
        'tome_id',
        'date_emprunt',
        'date_retour',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function manga(): BelongsTo
    {
        return $this->belongsTo(Manga::class);
    }
    public function tome()
{
    return $this->belongsTo(Tome::class);
}
}