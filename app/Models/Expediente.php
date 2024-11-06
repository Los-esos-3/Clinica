<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Expediente extends Model
{
    use HasFactory;
    protected $fillable = [
        'paciente_id',
        'doctor_id',
        'especialidad',
        'diagnostico',
        'tratamiento',
        'antecedentes',
        'familiar_a_cargo',
        'numero_familiar',
        'proxima_cita',
        'hora_proxima_cita', 
        'fecha_registro',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctores::class, 'doctor_id');
    }

    public function getHoraProximaCitaFormateadaAttribute()
    {
        if ($this->hora_proxima_cita) {
            return Carbon::parse($this->hora_proxima_cita)->format('h:i A');
        }
        return null;
    }
}
