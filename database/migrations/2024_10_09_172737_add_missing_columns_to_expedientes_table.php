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
        Schema::table('expedientes', function (Blueprint $table) {
            $table->string('familiar_a_cargo')->nullable();
            $table->string('numero_familiar')->nullable();
            $table->date('proxima_cita')->nullable();
            $table->date('fecha_registro');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('expedientes', function (Blueprint $table) {
            $table->dropColumn(['familiar_a_cargo', 'numero_familiar', 'proxima_cita', 'fecha_registro']);
        });
    }
};
