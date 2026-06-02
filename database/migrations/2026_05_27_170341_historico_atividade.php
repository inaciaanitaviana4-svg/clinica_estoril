<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historico_atividades', function (Blueprint $table) {
            $table->id('id_historico');

            // Quem fez a ação
            $table->unsignedBigInteger('id_util')->nullable();
            $table->string('nome_util', 150)->nullable();       // snapshot do nome no momento
            $table->string('tipo_util', 30)->nullable();        // admin | recepcionista | medico | paciente

            // O que foi feito
            $table->string('categoria', 30);                    // registro | consulta | atualizacao | pagamento
            $table->string('acao', 60);                         // cadastrou_usuario | agendou_consulta | etc.
            $table->string('descricao', 500)->nullable();       // texto legível para o humano

            // Sobre quem / o quê (entidade afetada)
            $table->string('entidade', 50)->nullable();         // Utilizador | Consulta | Pagamento | Paciente
            $table->unsignedBigInteger('id_entidade')->nullable();
            $table->string('nome_entidade', 150)->nullable();   // ex: nome do paciente, nº pagamento

            // Campos alterados (apenas para "atualizacao")
            $table->text('campos_alterados')->nullable();       // ["email","num_telefone"]

            // Dados extras (IP, etc.)
            $table->string('ip', 45)->nullable();
            $table->string('user_agent', 300)->nullable();

            $table->timestamp('criado_em')->useCurrent();

            // Índices
            $table->index('id_util');
            $table->index('categoria');
            $table->index('criado_em');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historico_atividades');
    }
};