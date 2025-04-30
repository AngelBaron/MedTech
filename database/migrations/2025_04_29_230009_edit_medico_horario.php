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
        //cambiar el nombre de la tabla a medico_horarios
        Schema::rename('medico_horario', 'medico_horarios');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //cambiar el nombre de la tabla a medico_horario
        Schema::rename('medico_horarios', 'medico_horario');
    }
};
