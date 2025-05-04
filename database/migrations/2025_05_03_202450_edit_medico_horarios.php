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
            $table->dropColumn('horario_inicio');
            $table->dropColumn('horario_fin');
            $table->time('horario_inicio');
            $table->time('horario_fin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medico_horarios', function (Blueprint $table) {
            $table->dropColumn('horario_inicio');
            $table->dropColumn('horario_fin');
            $table->string('horario_inicio');
            $table->string('horario_fin');
        });
    }
};
