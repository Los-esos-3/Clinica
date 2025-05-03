<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Empresa extends Model
{
    use HasRoles;
    protected $fillable = [
        'logo',
        'nombre',
        'telefono',
        'email',
        'direccion',
        'ciudad',
        'estado',
        'pais',
        'horario',
        'descripcion'
    ];

    public function users()
    {
        return $this->hasMany(User::class,'empresa_id');
    }

    public function doctor()
    {
        return $this->hasMany(Doctores::class);
    }
    public function secretarias()
    {
        return $this->hasMany(Secretarias::class);
    }
}
