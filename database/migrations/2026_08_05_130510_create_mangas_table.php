<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('mangas', function (Blueprint $table) {
        $table->id();
        $table->string('titre');
        $table->string('auteur');
        $table->string('genre');
        $table->integer('nombre_tomes')->default(1);
        $table->integer('tome_actuel')->default(1);
        $table->boolean('disponible')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mangas');
    }
};
