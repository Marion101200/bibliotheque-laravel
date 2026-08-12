<?php

namespace Tests\Feature;

use App\Models\Manga;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatalogueTest extends TestCase
{
    use RefreshDatabase;

    public function test_le_catalogue_est_accessible(): void
    {
        $response = $this->get(route('mangas.index'));

        $response->assertStatus(200);
    }

    public function test_un_manga_peut_etre_consulte(): void
    {
        $manga = Manga::factory()->create([
            'titre' => 'Jujutsu Kaisen',
        ]);

        $response = $this->get(route('mangas.show', $manga));

        $response->assertStatus(200);
        $response->assertSee('Jujutsu Kaisen');
    }
}