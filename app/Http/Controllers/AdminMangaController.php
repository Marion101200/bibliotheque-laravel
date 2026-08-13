<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Tome;

class AdminMangaController extends Controller
{
    public function index()
    {
        $mangas = Manga::all();

        return view('admin.mangas.index', compact('mangas'));
    }

    public function create()
    {
        return view('admin.mangas.create');
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'titre' => 'required|string|max:255',
        'auteur' => 'required|string|max:255',
        'genre' => 'required|string|max:255',
        'description' => 'nullable|string',
        'nombre_tomes' => 'required|integer|min:1',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'disponible' => 'required|boolean',
    ]);

    // Gestion de l'image
    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('mangas', 'public');
    }

    // Création du manga
    $manga = Manga::create($validated);

    // Création automatique des tomes
    for ($i = 1; $i <= $manga->nombre_tomes; $i++) {
        $manga->tomes()->create([
            'numero' => $i,
            'disponible' => true,
        ]);
    }

    return redirect()
        ->route('admin.mangas.index')
        ->with('success', 'Le manga et ses tomes ont été ajoutés avec succès.');
}

    public function edit(Manga $manga)
    {
        return view('admin.mangas.edit', compact('manga'));
    }

    public function update(Request $request, Manga $manga)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'auteur' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'nombre_tomes' => 'required|integer|min:1',
            'disponible' => 'required|boolean',
        ]);

        $imagePath = $manga->image;

        if ($request->hasFile('image')) {

            if ($manga->image) {
                Storage::disk('public')->delete($manga->image);
            }

            $imagePath = $request->file('image')->store('mangas', 'public');
        }

        $manga->update([
            'titre' => $request->titre,
            'auteur' => $request->auteur,
            'genre' => $request->genre,
            'description' => $request->description,
            'image' => $imagePath,
            'nombre_tomes' => $request->nombre_tomes,
            'disponible' => $request->disponible,
        ]);

        return redirect()
            ->route('admin.mangas.index')
            ->with('success', 'Manga modifié avec succès !');
    }

    public function destroy(Manga $manga)
    {
        if ($manga->image) {
            Storage::disk('public')->delete($manga->image);
        }

        $manga->delete();

        return redirect()
            ->route('admin.mangas.index')
            ->with('success', 'Manga supprimé avec succès !');
    }
}