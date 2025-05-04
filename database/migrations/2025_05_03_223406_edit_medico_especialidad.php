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
        //quitar la columna especialidad en la tabla medicos
        Schema::table('medicos', function (Blueprint $table) {
            $table->dropColumn('especialidad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //agregar la columna especialidad en la tabla medicos
        Schema::table('medicos', function (Blueprint $table) {
            $table->string('especialidad')->nullable();
        });
    }
};
