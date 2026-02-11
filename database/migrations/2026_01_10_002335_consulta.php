<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id('id_consulta');
            $table->integer('id_medico');
            $table->integer('id_paciente');
            $table->integer('id_espec');
            $table->date('data');
            $table->string('hora');
            $table->enum('estado', ['agendada', 'confirmada', 'cancelada', 'concluida','pendente']);
            $table->string('observacao')->nullable();
            $table->string('tipo_consulta')->nullable();
            $table->integer('id_recepcionista')->nullable();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};
