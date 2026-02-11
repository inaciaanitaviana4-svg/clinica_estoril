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
        Schema::create('medico', function (Blueprint $table) {
            $table->id("id_medico");
            $table->string('morada')->nullable();
            $table->string('num_telefone');
            $table->string('senha');
            $table->string('nome');
            $table->string('genero');
            $table->string('email');
            $table->string('especialidade');
            $table->integer('ano_experiencia');
            $table->integer('id_clinica');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    { 
                Schema::dropIfExists('medico');
        //
    }
};
