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
        Schema::create('notificacoes', function (Blueprint $table) {
            $table->id("id_notificacao");
            $table->string('titulo');
              $table->string('mensagem');
            $table->boolean('lida');
            $table->integer('id_util');
            $table->date('data');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    { 
                Schema::dropIfExists('notificacoes');
        //
    }
};
