<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;
use Illuminate\Http\RedirectResponse;

class RegisterResponse implements RegisterResponseContract
{
    public function toResponse($request)
    {
        return redirect()->route('welcome')
            ->with('success', 'Tu cuenta se ha creado con éxito. Actualmente cuentas con el rol de usuario, espera a que un administrador te dé otro rol para interactuar con nuestras herramientas.');
    }
}
