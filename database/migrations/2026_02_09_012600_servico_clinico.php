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
        Schema::create('servicos_clinicos', function (Blueprint $table) {
            $table->id("id_servico_clinico");
            $table->integer("id_tipo_consulta");
            $table->string('nome');
            $table->integer('duracao_min');
            $table->decimal('preco');
            $table->boolean('activo');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicos_clinicos');
        // 
    }
};
