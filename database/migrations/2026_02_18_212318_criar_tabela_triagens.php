<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('triagens', function (Blueprint $table) {
            $table->id("id_triagem");
            $table->integer('id_consulta');
            $table->integer('id_enfermeiro')->nullable();
            $table->string('queixa_principal');
            $table->decimal('temperatura', 4, 1)->nullable();
            $table->string('pressao_arterial', 7)->nullable(); // 120/80
            $table->integer('frequencia_cardiaca')->nullable();
            $table->integer('saturacao_oxigenio')->nullable();
            $table->unsignedTinyInteger('nivel_dor')->nullable(); // 0 a 10
            $table->text('observacoes')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('triagens');
    }
};
