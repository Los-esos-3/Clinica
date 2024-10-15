<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngresosTable extends Migration
{
    public function up()
    {
        Schema::create('ingresos', function (Blueprint $table) {
            $table->id();
            $table->string('departamento')->nullable();
            $table->unsignedBigInteger('paciente_id');
            $table->decimal('total', 8);
            $table->timestamps();

              });
    }


    public function down()
    {
        Schema::table('ingresos', function (Blueprint $table) {
            // Solo elimina la columna si existe
            if (Schema::hasColumn('ingresos', 'departamento')) {
                $table->dropColumn('departamento');
            }
        });
    }

}