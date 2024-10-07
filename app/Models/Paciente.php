<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'telefono',
        'fecha_nacimiento',
        'edad',
        'direccion',
        'genero',
        'estado_civil',
        'fecha_registro',
        'hora_registro',
        'tipo_sangre',
        'ocupacion',
    ];

    public function expedientes()
    {
        return $this->hasMany(Expediente::class);
    }
}
