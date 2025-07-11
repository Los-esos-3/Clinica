<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Secretarias extends Model
{
    use HasFactory, SoftDeletes;
    use HasRoles;

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
        'departamento',
        'experiencia_laboral',
        'contacto_emergencia_nombre',
        'contacto_emergencia_relacion',
        'contacto_emergencia_telefono',
        'idiomas',
        'empresa_id',
        'personal_id'
    ];

    protected $dates = [
        'fecha_nacimiento',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // Si quieres convertir algunos campos a arrays automáticamente
    protected $casts = [
        'experiencia_laboral' => 'array',
        'idiomas' => 'array'
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
        return $this->belongsTo(User::class);
    }
    public function doctor()
    {
        return $this->belongsTo(Doctores::class, 'doctor_id');
    }
}
