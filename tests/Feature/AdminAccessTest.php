<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_un_utilisateur_non_admin_ne_peut_pas_acceder_a_admin(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
        ]);

        $response = $this->actingAs($user)->get('/admin');

        $response->assertRedirect(route('mangas.index'));
    }

    public function test_un_admin_peut_acceder_a_admin(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->get('/admin');

        $response->assertStatus(200);
    }
    public function test_un_utilisateur_non_admin_ne_peut_pas_gerer_les_mangas(): void
{
    $user = User::factory()->create([
        'role' => 'user',
    ]);

    $response = $this->actingAs($user)
        ->get(route('admin.mangas.index'));

    $response->assertRedirect(route('mangas.index'));
}

public function test_un_utilisateur_non_admin_ne_peut_pas_modifier_un_manga(): void
{
    $user = User::factory()->create([
        'role' => 'user',
    ]);

    $manga = \App\Models\Manga::factory()->create();

    $response = $this->actingAs($user)
        ->get(route('admin.mangas.edit', $manga));

    $response->assertRedirect(route('mangas.index'));
}

public function test_un_utilisateur_non_admin_ne_peut_pas_supprimer_un_manga(): void
{
    $user = User::factory()->create([
        'role' => 'user',
    ]);

    $manga = \App\Models\Manga::factory()->create();

    $response = $this->actingAs($user)
        ->delete(route('admin.mangas.destroy', $manga));

    $response->assertRedirect(route('mangas.index'));

    $this->assertDatabaseHas('mangas', [
        'id' => $manga->id,
    ]);
}
    
    }