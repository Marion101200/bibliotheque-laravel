<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Manga extends Model
{
    use HasFactory;
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
