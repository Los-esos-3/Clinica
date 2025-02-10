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
        'pais',
        'horario',
        'descripcion'
    ];
    public function usuarios()
    {
        return $this->hasMany(User::class);
    }
}
