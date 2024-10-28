<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = [
        'logo',
        'nombre',
        'telefono',
        'email',
        'direccion',
        'ciudad',
        'pais',
        'horario',
        'descripcion'
    ];
}
