<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Manga;

class MangaSeeder extends Seeder
{
    public function run(): void
    {
        Manga::create([
            'titre' => 'One Piece',
            'auteur' => 'Eiichiro Oda',
            'genre' => 'Shonen',
            'description' => 'Les aventures de Luffy et son équipage à la recherche du One Piece.',
            'image' => null,
            'nombre_tomes' => 112,
            'disponible' => true
        ]);

        Manga::create([
            'titre' => 'L\'Attaque des Titans',
            'auteur' => 'Hajime Isayama',
            'genre' => 'Action',
            'description' => 'L\'humanité lutte pour survivre face aux Titans.',
            'image' => null,
            'nombre_tomes' => 34,
            'disponible' => true
        ]);

        Manga::create([
            'titre' => 'Jujutsu Kaisen',
            'auteur' => 'Gege Akutami',
            'genre' => 'Dark Fantasy',
            'description' => 'Yuji Itadori combat des fléaux avec l\'énergie occulte.',
            'image' => null,
            'nombre_tomes' => 30,
            'disponible' => true
        ]);

        Manga::create([
            'titre' => 'Frieren',
            'auteur' => 'Kanehito Yamada',
            'genre' => 'Fantasy',
            'description' => 'Une elfe mage découvre le temps qui passe après une grande aventure.',
            'image' => null,
            'nombre_tomes' => 14,
            'disponible' => true
        ]);
    }
}