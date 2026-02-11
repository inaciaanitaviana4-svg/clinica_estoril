<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('consultas', function (Blueprint $table) {
            // 1. Adicionar os novos campos
            $table->enum('modalidade', ['imediata', 'agendada'])->nullable();
            $table->integer('id_tipo_consulta')->nullable();
            $table->integer('id_servico_clinico')->nullable();

            // 2. Remover os campos antigos
            $table->dropColumn(['id_espec', 'tipo_consulta']);
        });
    }

    public function down(): void
    {
        Schema::table('consultas', function (Blueprint $table) {
            // Reverter a remoção (adicionar de volta)
            $table->string('id_espec')->nullable(); // Ajusta o tipo conforme era antes
            $table->string('tipo_consulta')->nullable();

            // Reverter a adição (remover os novos)
            $table->dropColumn(['modalidade', 'id_tipo_consulta', 'id_servico_clinico']);
        });
    }
};