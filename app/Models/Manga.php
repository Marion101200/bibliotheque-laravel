<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Manga extends Model
{
    protected $fillable = [
        'titre',
        'auteur',
        'genre',
        'description',
        'image',
        'nombre_tomes',
        'disponible'
    ];

    public function emprunts(): HasMany
{
    return $this->hasMany(Emprunt::class);
}
}
