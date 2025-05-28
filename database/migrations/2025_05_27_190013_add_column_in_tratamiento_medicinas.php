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
            $table->date('dia_ultima')->default(NULL)->after('estado')->nullable();
            $table->time('hora_ultima')->default(NULL)->after('dia_ultima')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tratamiento_medicamentos', function (Blueprint $table) {
            $table->dropColumn('dia_ultima');
            $table->dropColumn('hora_ultima');
        });
    }
};
