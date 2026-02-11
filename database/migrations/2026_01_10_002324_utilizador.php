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
        Schema::create('utilizadores', function (Blueprint $table) {
            $table->id("id_util");
            $table->string('num_telefone');
            $table->string('email');
            $table->string('genero');
            $table->string('nome');
            $table->string('senha');
            $table->integer('nivel_acesso');
            $table->integer('id_admi')->nullable();
            $table->integer('id_medico')->nullable();
            $table->integer('id_recepcionista')->nullable();
            $table->integer('id_paciente')->nullable();

        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilizadores');

    }
};
