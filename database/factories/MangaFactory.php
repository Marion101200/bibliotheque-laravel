<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Manga>
 */
class MangaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'titre' => fake()->sentence(3),
            'auteur' => fake()->name(),
            'genre' => fake()->randomElement([
                'Shonen',
                'Shojo',
                'Seinen',
                'Isekai',
            ]),
            'description' => fake()->paragraph(),
            'image' => null,
            'nombre_tomes' => fake()->numberBetween(1, 50),
            'disponible' => true,
        ];
    }
}