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
        Schema::table('archivos', function (Blueprint $table) {
            $table->unsignedBigInteger('tratamiento_id')
                ->nullable()
                ->after('receta_id'); // Esto ahora sí se aplica bien

            $table->foreign('tratamiento_id')
                ->references('id')
                ->on('tratamientos')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('archivos', function (Blueprint $table) {
            $table->dropForeign(['tratamiento_id']);
            $table->dropColumn('tratamiento_id');
        });
    }
};
