<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
