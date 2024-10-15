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
        Schema::create('expedientes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paciente_id');
            $table->string('doctor');
            $table->string('especialidad');
            $table->string('diagnostico');
            $table->string('tratamiento');
            $table->text('antecedentes')->nullable();
            $table->string('familiar')->nullable();
            $table->string('familiarnumero')->nullable();
            $table->date('proxima_cita')->nullable();
            $table->time('hora_proxima_cita')->nullable(); // Añade esta línea
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expedientes');
    }
};
