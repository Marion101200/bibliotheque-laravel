<?php

namespace App\Http\Controllers;

use App\Models\Emprunt;
use Illuminate\Http\Request;

class AdminEmpruntController extends Controller
{
    public function index(Request $request)
    {
        $query = Emprunt::with(['user', 'manga']);

        if ($request->filled('statut')) {

            if ($request->statut === 'en_cours') {
                $query->whereNull('date_retour');
            }

            if ($request->statut === 'termine') {
                $query->whereNotNull('date_retour');
            }
        }

        $emprunts = $query
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.emprunts.index', compact('emprunts'));
    }
}