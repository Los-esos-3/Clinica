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
            $table->unsignedBigInteger('doctor_id');
            $table->string('especialidad'); 
            $table->string('diagnostico');
            $table->string('tratamiento');
            $table->text('antecedentes')->nullable();
            $table->string('familiar_a_cargo')->nullable();
            $table->string('numero_familiar')->nullable();
            $table->date('proxima_cita')->nullable();
            $table->time('hora_proxima_cita')->nullable();
            $table->date('fecha_registro');
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
