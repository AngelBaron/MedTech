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
        Schema::create('tratamiento_medicamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tratamiento_id')->constrained('tratamientos')->onDelete('cascade');
            $table->foreignId('medicamento_id')->constrained('medicamentos')->onDelete('cascade');
            $table->integer('dosis')->default(1);
            $table->string('frecuencia')->default('diaria');
            $table->string('duracion_dias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tratamiento_medicamentos');
    }
};
