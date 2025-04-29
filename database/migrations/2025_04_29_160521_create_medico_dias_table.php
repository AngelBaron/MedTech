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
        Schema::create('medico_dias', function (Blueprint $table) {
            //primary key medico_id y dia_id
            
            $table->foreignId('medico_id')->constrained('medicos')->onDelete('cascade');
            $table->foreignId('dia_id')->constrained('dias')->onDelete('cascade');
            $table->primary(['medico_id', 'dia_id']);
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medico_dias');
    }
};
