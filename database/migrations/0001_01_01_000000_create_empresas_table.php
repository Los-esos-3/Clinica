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
    Schema::create('empresas', function (Blueprint $table) {
        $table->id();
        $table->string('logo')->nullable(); 
        $table->string('nombre');
        $table->string('telefono');
        $table->string('email')->unique();
        $table->string('direccion');
        $table->string('ciudad');
        $table->string('estado');
        $table->string('pais');
        $table->string('horario');
        $table->text('descripcion');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
