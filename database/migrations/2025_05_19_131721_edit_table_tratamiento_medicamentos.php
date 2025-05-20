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
        Schema::table('tratamiento_medicamentos', function (Blueprint $table) {
            $table->dropColumn('duracion_dias');
            $table->integer('duracion_dias')->after('frecuencia');
            $table->integer('dias_o_horas')->after('dosis');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tratamiento_medicamentos', function (Blueprint $table) {
            $table->dropColumn('dias_o_horas');
            $table->string('duracion_dias')->after('frecuencia');
            
        });
    }
};
