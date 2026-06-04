<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('notificacoes', function (Blueprint $table) {
           $table->integer('id_util')->unsigned()->change()->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('notificacoes', function (Blueprint $table) {
            // Remover a coluna id_util ao reverter a migração
          $table->integer('id_util');
        });
    }
};