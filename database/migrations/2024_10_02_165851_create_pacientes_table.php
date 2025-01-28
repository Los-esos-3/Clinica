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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('telefono');
            $table->date('fecha_nacimiento');
            $table->integer('edad');
            $table->string('direccion');
            $table->string('genero');
            $table->string('estado_civil');
            $table->date('fecha_registro');
            $table->time('hora_registro');
            $table->string('tipo_sangre');
            $table->string('ocupacion')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
