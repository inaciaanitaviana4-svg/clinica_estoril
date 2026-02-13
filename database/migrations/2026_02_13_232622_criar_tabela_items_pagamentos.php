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
        Schema::create('items_pagamentos', function (Blueprint $table) {
            $table->id("id_item_pagamento");
            $table->unsignedBigInteger('id_pagamento');
            $table->unsignedBigInteger('id_servico_clinico');
            $table->integer('quantidade')->default(1);
            $table->decimal('valor', 10, 2); // Valor unitário
            $table->decimal('total', 10, 2); // Quantidade * Valor

            $table->foreign('id_pagamento')->references('id_pagamento')->on('pagamentos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items_pagamentos');
    }
};
