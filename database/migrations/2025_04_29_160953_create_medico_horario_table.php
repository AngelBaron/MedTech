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
        Schema::create('medico_horario', function (Blueprint $table) {
            $table->foreignId('medico_id')->constrained('medicos')->onDelete('cascade');
            $table->enum('horario_inicio', ['08:00', '16:00', '24:00']);
            $table->enum('horario_fin', ['08:00', '16:00', '24:00']);
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medico_horario');
    }
};
