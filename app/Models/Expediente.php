<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expediente extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'doctor',
        'especialidad',
        'diagnostico',
        'tratamiento',
        'antecedentes',
        'familiar', 
        'famialiarnumero',
        'proximacita'
    ];


    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
    
}
