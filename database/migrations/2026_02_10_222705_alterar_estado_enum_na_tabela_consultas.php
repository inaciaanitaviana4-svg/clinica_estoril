<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('consultas', function (Blueprint $table) {
            // Redefinimos o enum com os valores existentes + os novos
            // Substitui 'pendente', 'concluido' pelos valores que já tinhas antes
            $table->enum('estado', [
                'agendada',
                'confirmada',
                'cancelada',
                'concluida',
                'pendente',
                'em_andamento',
                'em_espera'
            ])->default('pendente')->change();
        });
    }

    public function down(): void
    {
        Schema::table('consultas', function (Blueprint $table) {
            // Para reverter, voltamos à lista original (removendo os novos)
            $table->enum('estado', [
                'agendada',
                'confirmada',
                'cancelada',
                'concluida',
                'pendente',
                'em_andamento',
                'em_espera'
            ])->change();
        });
    }
};