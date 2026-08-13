<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Tome;


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
public function tomes(): HasMany
{
    return $this->hasMany(Tome::class);
}
}
