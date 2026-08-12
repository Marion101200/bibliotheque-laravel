<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MangaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminMangaController;
use App\Http\Controllers\EmpruntController;
use App\Http\Controllers\AdminEmpruntController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('mangas', MangaController::class);

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::get('/admin', [AdminController::class, 'index'])
        ->middleware('admin')
        ->name('admin');

    Route::get('/admin-test', function () {
        return "Bienvenue dans l'espace admin";
    })->middleware('admin');

    
Route::get('/mes-emprunts', [EmpruntController::class, 'index'])
    ->name('emprunts.index');

Route::post('/mangas/{manga}/emprunter', [EmpruntController::class, 'store'])
    ->name('emprunts.store');

Route::delete('/emprunts/{emprunt}', [EmpruntController::class, 'destroy'])
    ->name('emprunts.destroy');
    
    // Routes de gestion des mangas pour l'administrateur
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {

        Route::get('/mangas', [AdminMangaController::class, 'index'])
            ->name('mangas.index');

        Route::get('/mangas/create', [AdminMangaController::class, 'create'])
            ->name('mangas.create');

        Route::post('/mangas', [AdminMangaController::class, 'store'])
            ->name('mangas.store');

        Route::get('/mangas/{manga}/edit', [AdminMangaController::class, 'edit'])
            ->name('mangas.edit');

        Route::put('/mangas/{manga}', [AdminMangaController::class, 'update'])
            ->name('mangas.update');

        Route::delete('/mangas/{manga}', [AdminMangaController::class, 'destroy'])
            ->name('mangas.destroy');
            Route::get('/emprunts', [AdminEmpruntController::class, 'index'])
    ->name('emprunts.index');
    });
});

require __DIR__.'/auth.php';
