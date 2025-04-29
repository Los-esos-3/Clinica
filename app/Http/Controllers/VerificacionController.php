<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class VerificacionController 
{
    // Muestra el formulario para ingresar el código de verificación
    public function form(Request $request)
    {
        if (!Session::has('registered_email')) {
            return redirect()->route('register');
        }
        return view('auth.verify');
    }

    // Verifica el código enviado por el usuario
    public function verificar(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'verification_code' => 'required|digits:6'
        ]);

        $user = User::where('email', $request->email)
                    ->where('verification_code', $request->verification_code)
                    ->first();

        if (!$user) {
            return back()->withInput()->withErrors([
                'verification_code' => 'Código incorrecto o expirado.'
            ]);
        }

        // Actualizar el usuario como verificado
        $user->update([
            'email_verified_at' => now(),
            'verification_code' => null
        ]);

        // Limpiar la sesión
        Session::forget('registered_email');

        // Autenticar al usuario
        Auth::login($user);

        return redirect()->route('dashboard')
            ->with('success', '¡Cuenta verificada con éxito!');
    }
}
