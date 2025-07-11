<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Paciente extends Model
{

    use HasRoles;
    use HasFactory;
    protected $fillable = [
        'foto_perfil',
        'doctor_id',
        'secretaria_id',
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
        'user_id',
    ];

    public function expediente()
    {
        return $this->hasOne(Expediente::class);
    }
    public function expedientes()
{
    return $this->hasMany(Expediente::class);
}
    public function consultas()
    {
        return $this->hasMany(Consulta::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function doctor()
    {
        return $this->belongsTo(Doctores::class, 'doctor_id');
    }
    public function secretaria()
    {
        return $this->belongsTo(Secretarias::class,'doctor_id');
    }
}
