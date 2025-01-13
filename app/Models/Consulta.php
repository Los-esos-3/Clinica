<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $fillable = [
        'medico_id',
        'paciente_id',
        'fecha_hora',
        'motivo_consulta',
        'diagnostico',
        'tratamiento',
        'receta_medica',
        'indicaciones',
        'pruebas_solicitadas',
        'notas_adicionales',
        'fecha_proxima_cita',
        'estado',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctores::class, 'medico_id');
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }
}
