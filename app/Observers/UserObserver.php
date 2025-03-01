<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Doctores;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //
    }

    /**
     * Handle the User "updated" event.
     */
    public function updating(User $user)
    {
        // Verificar si el rol ha cambiado
        if ($user->isDirty('role')) { 
            // Si el usuario tiene el rol de 'doctor' y aún no tiene un registro en doctores
            if ($user->hasRole('Doctor') && !Doctores::where('user_id', $user->id)->exists()) {
                Doctores::create([
                    'user_id' => $user->id,
                    'empresa_id' => $user->empresa_id, // Asegurar que tenga una empresa
                    'nombre_completo' => $user->name,
                    'email' => $user->email,
                ]);
            }
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
