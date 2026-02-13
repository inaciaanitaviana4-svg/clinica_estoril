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
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->id('id_pagamento');
            $table->decimal('total_pago', 10, 2);
            $table->unsignedBigInteger('id_paciente');
            $table->unsignedBigInteger('id_recepcionista');
            $table->unsignedBigInteger('id_consulta')->nullable(); // Como pedido (?)
            $table->unsignedBigInteger('id_metodo_pagamento');
            $table->date('data');
            $table->enum('estado', ['sucesso', 'cancelado', 'pendente'])->default('pendente');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagamentos');
    }
};
