<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | DIAGNÓSTICOS
        |--------------------------------------------------------------------------
        */
        Schema::create('diagnosticos', function (Blueprint $table) {
            $table->id("id_diagnostico");
            $table->unsignedInteger('id_consulta');
            $table->text('descricao');
            $table->timestamp('criado_em')->nullable();
            $table->timestamp('actualizado_em')->nullable();
        });

        /*
        |--------------------------------------------------------------------------
        | EXAMES SOLICITADOS
        |--------------------------------------------------------------------------
        */
        Schema::create('exames_solicitados', function (Blueprint $table) {
            $table->id("id_exame_solicitado");
            $table->unsignedInteger('id_consulta');
            $table->unsignedInteger('id_servico_clinico');
            $table->text('resultado')->nullable();
            $table->text('observacoes')->nullable();
            $table->enum('status', ['PENDENTE', 'REALIZADO'])
                ->default('PENDENTE');

            $table->timestamp('criado_em')->nullable();
            $table->timestamp('actualizado_em')->nullable();
        });

        /*
        |--------------------------------------------------------------------------
        | RECEITAS
        |--------------------------------------------------------------------------
        */
        Schema::create('receitas', function (Blueprint $table) {
            $table->id("id_receita");
            $table->unsignedInteger('id_consulta');
            $table->text('observacoes')->nullable();

            $table->timestamp('criado_em')->nullable();
            $table->timestamp('actualizado_em')->nullable();
        });

        /*
        |--------------------------------------------------------------------------
        | ITENS DA RECEITA
        |--------------------------------------------------------------------------
        */
        Schema::create('receitas_itens', function (Blueprint $table) {
            $table->id("id_receita_item");
            $table->unsignedInteger('id_receita');
            $table->string('medicamento');
            $table->string('dosagem')->nullable();
            $table->string('frequencia')->nullable();
            $table->string('duracao')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('receitas_itens');
        Schema::dropIfExists('receitas');
        Schema::dropIfExists('exames_solicitados');
        Schema::dropIfExists('diagnosticos');
    }
};
