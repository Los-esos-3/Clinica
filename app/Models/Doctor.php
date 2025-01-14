<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasFactory;
    
    protected $table = 'doctores';
    
    protected $fillable = [
        'nombre_completo',
        'fecha_nacimiento',
        'genero',
        'telefono',
        'email',
        'domicilio',
        'nacionalidad',
        'foto_perfil',
        'especialidad_medica',
        'universidad',
        'titulo',
        'año_graduacion',
        'años_experiencia',
        'hospitales_previos',
        'idiomas',
        'contacto_emergencia_nombre',
        'contacto_emergencia_relacion',
        'contacto_emergencia_telefono',
        'area_departamento'
    ];
} 