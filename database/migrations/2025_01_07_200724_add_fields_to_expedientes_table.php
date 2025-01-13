<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToExpedientesTable extends Migration
{
    public function up()
    {
        Schema::table('expedientes', function (Blueprint $table) {
            $table->string('numero_expediente')->unique();
            $table->date('fecha_creacion');
            $table->unsignedBigInteger('medico_id');
            $table->string('estado'); // Activo/Inactivo
            $table->text('alergias')->nullable();
            $table->text('antecedentes_medicos')->nullable();
            $table->text('historial_quirurgico')->nullable();
            $table->text('historial_familiar')->nullable();
            $table->text('vacunas')->nullable();
            $table->text('medicamentos')->nullable();
            $table->text('estudios_previos')->nullable();
            $table->text('notas_medicas')->nullable();

            // Agregar las claves foráneas
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
            $table->foreign('medico_id')->references('id')->on('doctores')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('expedientes', function (Blueprint $table) {
            $table->dropForeign(['paciente_id']);
            $table->dropForeign(['medico_id']);
            $table->dropColumn([
                'numero_expediente',
                'paciente_id',
                'fecha_creacion',
                'medico_id',
                'estado',
                'alergias',
                'antecedentes_medicos',
                'historial_quirúrgico',
                'historial_familiar',
                'vacunas',
                'medicamentos',
                'estudios_previos',
                'notas_medicas',
            ]);
        });
    }
}
