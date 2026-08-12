<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Manga;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmpruntTest extends TestCase
{
    use RefreshDatabase;

    public function test_un_utilisateur_peut_emprunter_un_manga_disponible(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
        ]);

        $manga = Manga::factory()->create([
            'disponible' => true,
        ]);

        $response = $this->actingAs($user)
            ->post(route('emprunts.store', $manga));

        $response->assertRedirect();

        $this->assertDatabaseHas('emprunts', [
            'user_id' => $user->id,
            'manga_id' => $manga->id,
        ]);

        $this->assertDatabaseHas('mangas', [
            'id' => $manga->id,
            'disponible' => false,
        ]);
    }

    public function test_un_utilisateur_ne_peut_pas_emprunter_un_manga_indisponible(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
        ]);

        $manga = Manga::factory()->create([
            'disponible' => false,
        ]);

        $response = $this->actingAs($user)
            ->post(route('emprunts.store', $manga));

        $response->assertRedirect();

        $this->assertDatabaseMissing('emprunts', [
            'user_id' => $user->id,
            'manga_id' => $manga->id,
        ]);
    }

    public function test_un_utilisateur_peut_rendre_son_manga(): void
{
    $user = User::factory()->create([
        'role' => 'user',
    ]);

    $manga = Manga::factory()->create([
        'disponible' => false,
    ]);

    $emprunt = \App\Models\Emprunt::create([
        'user_id' => $user->id,
        'manga_id' => $manga->id,
        'date_emprunt' => now(),
    ]);

   $response = $this->actingAs($user)
    ->delete(route('emprunts.destroy', $emprunt));

    $response->assertRedirect();

    $this->assertDatabaseHas('emprunts', [
        'id' => $emprunt->id,
    ]);

    $this->assertDatabaseHas('mangas', [
        'id' => $manga->id,
        'disponible' => true,
    ]);
}

public function test_un_utilisateur_ne_peut_pas_rendre_le_manga_d_un_autre_utilisateur(): void
{
    $user = User::factory()->create([
        'role' => 'user',
    ]);

    $autreUser = User::factory()->create([
        'role' => 'user',
    ]);

    $manga = Manga::factory()->create([
        'disponible' => false,
    ]);

    $emprunt = \App\Models\Emprunt::create([
        'user_id' => $autreUser->id,
        'manga_id' => $manga->id,
        'date_emprunt' => now(),
    ]);

$response = $this->actingAs($user)
    ->delete(route('emprunts.destroy', $emprunt));

    $response->assertForbidden();
}
}