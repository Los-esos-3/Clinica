<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Symfony\Component\Routing\Loader\Configurator\Traits\AddTrait;

class Personal extends Model
{
    use HasFactory;
    use HasRoles;

    protected $fillable = [
        'nombre',
        'foto_perfil',
        'user_id',
        'correo',
        'tel',
        'password',
        'rol',
        'empresa_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }
}
