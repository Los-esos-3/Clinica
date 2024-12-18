<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medico_id');
            $table->dateTime('fecha_hora');
            $table->text('motivo_consulta');
            $table->text('diagnostico')->nullable();
            $table->text('tratamiento')->nullable();
            $table->text('receta_medica')->nullable();
            $table->text('indicaciones')->nullable();
            $table->text('pruebas_solicitadas')->nullable();
            $table->text('notas_adicionales')->nullable();
            $table->date('fecha_proxima_cita')->nullable();
            $table->enum('estado', ['Completada', 'Pendiente', 'Cancelada'])->default('Pendiente');
            $table->timestamps();

            $table->foreign('medico_id')->references('id')->on('doctores')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};