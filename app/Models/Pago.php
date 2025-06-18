<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $fillable = [
        'user_id',
        'plan',
        'precio',
        'referencia',
        'fecha_generacion',
        'tipo_pago',
        'ticket'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

