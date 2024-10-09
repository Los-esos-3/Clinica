<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    use HasFactory;
    protected $fillable = [
        'paciente_id',
        'doctor',
        'especialidad',
        'diagnostico',
        'tratamiento',
        'antecedentes',
        'familiar_a_cargo',
        'numero_familiar',
        'proxima_cita',
        'fecha_registro',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
    
}
