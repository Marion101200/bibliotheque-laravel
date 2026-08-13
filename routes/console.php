<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
Artisan::command('mangas:create-tomes', function () {

    $mangas = \App\Models\Manga::all();

    foreach ($mangas as $manga) {

        for ($i = 1; $i <= $manga->nombre_tomes; $i++) {

            $manga->tomes()->firstOrCreate(
                ['numero' => $i],
                ['disponible' => true]
            );
        }

        $this->info(
            $manga->titre . ' : ' . $manga->nombre_tomes . ' tome(s) vérifié(s).'
        );
    }

    $this->info('Tous les tomes ont été créés.');

});