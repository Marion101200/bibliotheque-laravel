<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('emprunts', function (Blueprint $table) {
            $table->foreignId('tome_id')
                ->nullable()
                ->after('manga_id')
                ->constrained('tomes')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('emprunts', function (Blueprint $table) {
            $table->dropForeign(['tome_id']);
            $table->dropColumn('tome_id');
        });
    }
};