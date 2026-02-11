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
        Schema::create('horarios', function (Blueprint $table) {
            $table->id("id_horario");
            $table->string('hora');
            $table->boolean('activo');
            $table->integer('id_medico')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    { 
                Schema::dropIfExists('horarios');
        //
    }
};
