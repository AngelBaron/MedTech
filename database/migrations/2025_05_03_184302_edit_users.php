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
        //editar la columna horario_inicio de enum a set en la tabla medico_horarios
        Schema::table('medico_horarios', function (Blueprint $table) {
           
            $table->dropColumn('horario_inicio');
            $table->set('horario_inicio', ['08:00', '16:00','24:00'])->after('medico_id');

        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revertir la migración si es necesario
        Schema::table('medico_horarios', function (Blueprint $table) {
            $table->dropColumn('horario_inicio');
            $table->enum('horario_inicio', ['08:00', '14:00','24:00'])->after('medico_id');
        });
    }
};
