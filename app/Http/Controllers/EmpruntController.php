<?php

namespace App\Http\Controllers;

use App\Models\Emprunt;
use App\Models\Manga;
use Illuminate\Http\Request;
use App\Models\Tome;
class EmpruntController extends Controller
{
public function index()
{
    $emprunts = auth()->user()
        ->emprunts()
        ->with('tome.manga')
        ->whereNull('date_retour')
        ->get();

    return view('mes-emprunts', compact('emprunts'));
}
public function store(Request $request, Tome $tome)
{
    // Vérifie que le tome est disponible
    if (!$tome->disponible) {
        return back()->with('error', 'Ce tome est déjà emprunté.');
    }

Emprunt::create([
    'user_id' => auth()->id(),
    'manga_id' => $tome->manga_id,
    'tome_id' => $tome->id,
    'date_emprunt' => now()->toDateString(),
]);
    // Rend uniquement ce tome indisponible
    $tome->update([
        'disponible' => false,
    ]);

    return back()->with('success', 'Tome emprunté avec succès !');
}

public function destroy(Emprunt $emprunt)
{
    // Vérifie que l'emprunt appartient bien à l'utilisateur connecté
    if ($emprunt->user_id !== auth()->id()) {
        abort(403);
    }

    // Si l'emprunt possède un tome
    if ($emprunt->tome) {

        // Rend uniquement ce tome disponible
        $emprunt->tome->update([
            'disponible' => true,
        ]);

    } else {

        // Ancien emprunt créé avant la gestion des tomes
        $emprunt->manga->update([
            'disponible' => true,
        ]);
    }

    // Enregistre la date de retour
    $emprunt->update([
        'date_retour' => now()->toDateString(),
    ]);

    return back()->with('success', 'Emprunt rendu avec succès !');
}
}
