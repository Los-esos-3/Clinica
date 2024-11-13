<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Ingreso extends Model
{

    use HasRoles;
    use HasFactory;

    protected $table = 'ingresos';

    protected $fillable = [ 'paciente_id', 'total',  'departamento'];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }
}
