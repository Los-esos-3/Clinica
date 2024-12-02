<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    // Especifica los campos que se pueden llenar masivamente
    protected $fillable = [
        'titulo',              // Título de la cita
        'fecha_hora_inicio',   // Fecha y hora de inicio
        'fecha_hora_fin',      // Fecha y hora de fin
        // Agrega otros campos que necesites
    ];

    // Si necesitas definir relaciones, puedes hacerlo aquí
    // Por ejemplo, si una cita pertenece a un usuario:
    public function usuario()
    {
        return $this->belongsTo(User::class); // Asegúrate de que el modelo User esté importado
    }

    // O si una cita pertenece a un doctor
    public function doctor()
    {
        return $this->belongsTo(Doctores::class); // Asegúrate de que el modelo Doctor esté importado
    }
}