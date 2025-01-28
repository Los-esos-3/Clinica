<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('citas', function (Blueprint $table) {
        $table->id();
        $table->date('fecha');
        $table->time('hora_inicio');
        $table->time('hora_fin');
        $table->unsignedBigInteger('doctor_id');
        $table->unsignedBigInteger('paciente_id');
        $table->text('motivo');
        $table->timestamps();

        // Relaciones
        $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
        $table->foreign('doctor_id')->references('id')->on('doctores')->onDelete('cascade');
        });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
