<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('servicos_clinicos_especialidades', function (Blueprint $table) {
            $table->integer("id_servico_clinico");
            $table->integer("id_especialidade");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicos_clinicos_especialidades');
        // 
    }
};