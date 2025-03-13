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
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->string('numero_expediente')->unique();
            $table->date('fecha_registro');
            $table->string('estado');
            $table->text('alergias')->nullable();
            $table->text('antecedentes_medicos')->nullable();
            $table->text('historial_quirurgico')->nullable();
            $table->text('historial_familiar')->nullable();
            $table->text('vacunas')->nullable();
            $table->text('medicamentos')->nullable();
            $table->text('estudios_previos')->nullable();
            $table->text('notas_medicas')->nullable();
            $table->timestamps();

            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('doctores')->onDelete('cascade');
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
