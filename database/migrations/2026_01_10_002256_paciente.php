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
        Schema::create('paciente', function (Blueprint $table) {
            $table->id("id_paciente");
            $table->string('morada')->nullable();
            $table->string('num_telefone');
            $table->string('senha');
            $table->string('nome');
            $table->string('genero');
            $table->string('email');
            $table->string('data_nascimento');
            $table->string('num_bi');
            $table->string('estado_civil');
            $table->string('cidade');
            $table->string('bairro');
            $table->string('seguro')->nullable();
            $table->integer('id_clinica');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    { 
                Schema::dropIfExists('paciente');
        //
    }
};
