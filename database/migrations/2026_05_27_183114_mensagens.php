<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mensagens', function (Blueprint $table) {
            $table->id('id_mensagem');
            $table->unsignedBigInteger('id_consulta');          // Consulta a que pertence
            $table->unsignedBigInteger('id_remetente');         // id_util do remetente
            $table->unsignedBigInteger('id_destinatario');      // id_util do destinatário
            $table->text('conteudo');
            $table->boolean('lida')->default(false);
            $table->timestamp('lida_em')->nullable();
            $table->timestamps();                               // created_at, updated_at

            $table->foreign('id_consulta')->references('id_consulta')->on('consultas')->onDelete('cascade');
            $table->foreign('id_remetente')->references('id_util')->on('utilizadores')->onDelete('cascade');
            $table->foreign('id_destinatario')->references('id_util')->on('utilizadores')->onDelete('cascade');

            $table->index(['id_consulta', 'created_at']);
            $table->index(['id_destinatario', 'lida']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mensagens');
    }
};