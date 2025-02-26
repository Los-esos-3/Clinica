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
            $table->string('telefono')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('domicilio')->nullable();
            $table->string('nacionalidad')->nullable();
            $table->string('foto_perfil')->nullable(); 
            $table->string('departamento')->nullable();
            $table->json('experiencia_laboral')->nullable(); 
            $table->string('contacto_emergencia_nombre')->nullable();
            $table->string('contacto_emergencia_relacion')->nullable();
            $table->string('contacto_emergencia_telefono')->nullable();
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
