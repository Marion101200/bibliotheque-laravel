<?php

namespace App\Http\Controllers;

use App\Models\Emprunt;
use App\Models\Manga;
use Illuminate\Http\Request;

class EmpruntController extends Controller
{
    public function index()
{
$emprunts = auth()->user()
->emprunts()
->with('manga')
->whereNull('date_retour')
->get();

return view('mes-emprunts', compact('emprunts'));

}
    public function store(Request $request, Manga $manga)
    {
        // Vérifie que le manga est disponible
        if (!$manga->disponible) {
            return back()->with('error', 'Ce manga est déjà emprunté.');
        }

        // Crée l'emprunt
        Emprunt::create([
            'user_id' => auth()->id(),
            'manga_id' => $manga->id,
            'date_emprunt' => now()->toDateString(),
        ]);

        // Rend le manga indisponible
        $manga->update([
            'disponible' => false,
        ]);

        return back()->with('success', 'Manga emprunté avec succès !');
    }

    public function destroy(Emprunt $emprunt)
{
// Vérifie que l'emprunt appartient bien à l'utilisateur connecté
if ($emprunt->user_id !== auth()->id()) {
abort(403);
}

// Rend le manga disponible
$emprunt->manga->update([
    'disponible' => true,
]);

// Enregistre la date de retour
$emprunt->update([
    'date_retour' => now()->toDateString(),
]);

return back()->with('success', 'Manga rendu avec succès !');

}
}
