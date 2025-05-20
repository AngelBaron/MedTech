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
            $table->string('estado')->default('no validado')->after('duracion_dias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tratamiento_medicamentos', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
    }
};
