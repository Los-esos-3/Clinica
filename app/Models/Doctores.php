<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctores extends Model
{
    use HasFactory, SoftDeletes;

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

    protected $dates = [
        'fecha_nacimiento',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // Si quieres convertir algunos campos a arrays automáticamente
    protected $casts = [
        'hospitales_previos' => 'array',
        'idiomas' => 'array'
    ];
} 