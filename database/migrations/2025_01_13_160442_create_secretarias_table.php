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
        Schema::create('secretarias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained()->onDelete('cascade');
            $table->string('nombre_completo');
            $table->date('fecha_nacimiento');
            $table->string('genero');
            $table->string('telefono');
            $table->string('email')->unique();
            $table->string('domicilio');
            $table->string('nacionalidad');
            $table->string('foto_perfil')->nullable(); 
            $table->string('departamento');
            $table->json('experiencia_laboral')->nullable(); 
            $table->string('contacto_emergencia_nombre');
            $table->string('contacto_emergencia_relacion');
            $table->string('contacto_emergencia_telefono');
            $table->json('idiomas')->nullable(); 
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secretarias');
    }
};
