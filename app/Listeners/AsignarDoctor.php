<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UsuarioCreado;
use App\Models\Doctor;
use App\Models\Doctores;

class AsignarDoctor
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UsuarioCreado $event)
    {
        $user = $event->user;

        // Verificar si el usuario tiene el rol de Doctor y no tiene un registro en `doctores`
        if ($user->hasRole('Doctor') && !Doctores::where('user_id', $user->id)->exists()) {
            Doctores::create([
                'user_id' => $user->id,
                'empresa_id' => $user->empresa_id, // Ajusta según tu estructura
                'nombre_completo' => $user->name,
                'email' => $user->email,
            ]);
        }
    } 
}
