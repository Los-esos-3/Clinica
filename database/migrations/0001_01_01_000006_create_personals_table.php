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
        Schema::create('personals', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('foto_perfil')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Cambiado de constrain() a constrained()
            $table->string('tel')->nullable(); // Agregar este campo
            $table->string('correo')->unique();
            $table->string('password');
            $table->string('rol'); // Agregar la columna "rol"
            $table->unsignedBigInteger('empresa_id')->nullable(); // Agregar este campo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Personal');
    }
};
