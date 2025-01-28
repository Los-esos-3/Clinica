<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'hora_inicio',
        'hora_fin',
        'doctor_id',
        'paciente_id',
        'motivo',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctores::class, 'doctor_id');
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }
}

