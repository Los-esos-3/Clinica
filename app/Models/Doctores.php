<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctores extends Model
{
    use HasFactory;

    protected $table = 'doctores';

    protected $fillable = [
        'nombre_completo',
        'user_id',
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
        'area_departamento',
        'empresa_id',
        'personal_id'
    ];
    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
    public function pacientes()
{
    return $this->hasMany(Paciente::class, 'doctor_id');
}
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function secretarias()
    {
        return $this->hasMany(Secretarias::class, 'doctor_id');
    }
} 