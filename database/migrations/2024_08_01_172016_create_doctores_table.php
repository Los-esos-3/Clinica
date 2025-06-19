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
            $table->foreignId('empresa_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrain()->onDelete('cascade');
            $table->foreignId('personal_id')->constrained('Personals')->onDelete('cascade'); // Especificar 'Personal' si no sigue la convención
            $table->string('nombre_completo');
            $table->date('fecha_nacimiento')->nullable();
            $table->enum('genero', ['Masculino', 'Femenino', 'Otro'])->nullable();
            $table->string('telefono', 15)->nullable();
            $table->string('email')->unique();
            $table->text('domicilio')->nullable();
            $table->string('nacionalidad')->nullable();
            $table->string('foto_perfil')->nullable();
            $table->string('especialidad_medica')->nullable();
            $table->string('universidad')->nullable();
            $table->string('titulo')->nullable();
            $table->year('año_graduacion')->nullable();
            $table->integer('años_experiencia')->nullable();
            $table->text('hospitales_previos')->nullable();
            $table->string('idiomas')->nullable();
            
            // Información de contacto de emergencia
            $table->string('contacto_emergencia_nombre')->nullable();
            $table->string('contacto_emergencia_relacion')->nullable();
            $table->string('contacto_emergencia_telefono')->nullable();
            
            // Área o departamento
            $table->string('area_departamento')->nullable();
            
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
