<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('consultas', function (Blueprint $table) {
            $table->timestamp('data_marcacao')->useCurrent();
            $table->timestamp('data_atualizacao')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::table('consultas', function (Blueprint $table) {
            // Remover a coluna data_marcacao ao reverter a migração
            $table->dropColumn(['data_marcacao']);
            // Remover a coluna data_atualizacao ao reverter a migração
            $table->dropColumn(['data_atualizacao']);
        });
    }
};