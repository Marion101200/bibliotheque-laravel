<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use App\Models\User;
use App\Models\Emprunt;

class AdminController extends Controller
{
    public function index()
    {
        $nombreMangas = Manga::count();

        $nombreUtilisateurs = User::count();

        $empruntsEnCours = Emprunt::whereNull('date_retour')->count();

        $empruntsTermines = Emprunt::whereNotNull('date_retour')->count();

        return view('admin.index', compact(
            'nombreMangas',
            'nombreUtilisateurs',
            'empruntsEnCours',
            'empruntsTermines'
        ));
    }
}