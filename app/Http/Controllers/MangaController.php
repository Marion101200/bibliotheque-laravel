<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manga;

class MangaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Manga::query();

        // Recherche par titre ou auteur
        if ($request->filled('recherche')) {
            $recherche = $request->recherche;

            $query->where(function ($q) use ($recherche) {
                $q->where('titre', 'like', '%' . $recherche . '%')
                  ->orWhere('auteur', 'like', '%' . $recherche . '%');
            });
        }

        // Filtre par genre
        if ($request->filled('genre')) {
            $query->where('genre', $request->genre);
        }

        // Filtre par disponibilité
        if ($request->filled('disponibilite')) {
            $query->where('disponible', $request->disponibilite);
        }

        $mangas = $query->get();

        $genres = Manga::whereNotNull('genre')
            ->where('genre', '!=', '')
            ->distinct()
            ->pluck('genre');

        return view('catalogue', compact('mangas', 'genres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
public function show(string $id)
{
    $manga = Manga::with('tomes')->findOrFail($id);

    return view('manga-details', compact('manga'));
}
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
