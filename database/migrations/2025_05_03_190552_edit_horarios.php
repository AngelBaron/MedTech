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
        Schema::table('medico_horarios', function (Blueprint $table) {
           
            $table->dropColumn('horario_fin');
            $table->set('horario_fin', ['16:00', '24:00','08:00'])->after('horario_inicio');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medico_horarios', function (Blueprint $table) {
            $table->dropColumn('horario_fin');
            $table->enum('horario_fin', ['08:00', '16:00','24:00'])->after('horario_inicio');
        });
    }
};
