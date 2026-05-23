<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('servicos_clinicos', function (Blueprint $table) {
            $table->boolean('possui_horario')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('servicos_clinicos', function (Blueprint $table) {
            // Remover a coluna possui_horario ao reverter a migração
            $table->dropColumn(['possui_horario']);
        });
    }
};