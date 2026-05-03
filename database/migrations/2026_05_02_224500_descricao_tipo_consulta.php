<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('tipos_consultas', function (Blueprint $table) {
            $table->string('descricao')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('tipos_consultas', function (Blueprint $table) {
            // Reverter a adição (remover os novos)
            $table->dropColumn(['descricao']);
        });
    }
};