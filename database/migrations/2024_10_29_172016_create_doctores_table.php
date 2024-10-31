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
        Schema::create('doctores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_completo');
            $table->date('fecha_nacimiento');
            $table->enum('genero', ['Masculino', 'Femenino', 'Otro']);
            $table->string('telefono', 15);
            $table->string('email')->unique();
            $table->text('domicilio');
            $table->string('nacionalidad');
            $table->string('foto_perfil')->nullable();
            $table->string('especialidad_medica');
            $table->string('universidad');
            $table->string('titulo');
            $table->year('año_graduacion');
            $table->integer('años_experiencia');
            $table->text('hospitales_previos')->nullable();
            $table->string('idiomas');
            
            // Información de contacto de emergencia
            $table->string('contacto_emergencia_nombre');
            $table->string('contacto_emergencia_relacion');
            $table->string('contacto_emergencia_telefono');
            
            // Área o departamento
            $table->string('area_departamento');
            
            $table->timestamps();
            $table->softDeletes(); // Para borrado lógico
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctores');
    }
};
