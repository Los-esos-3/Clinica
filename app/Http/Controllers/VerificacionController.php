<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificacionController extends Controller
{
    // Muestra el formulario para ingresar el código de verificación
    public function form(Request $request)
    {
        return view('auth.verificar', ['email' => $request->email]);
    }

    // Verifica el código enviado por el usuario
    public function verificar(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'verification_code' => 'required|digits:6' // Asegúrate que coincida con el nombre en la vista
    ]);

    $user = User::where('email', $request->email)
                ->where('verification_code', $request->verification_code)
                ->first();

    if (!$user) {
        return back()->withInput()->withErrors([
            'verification_code' => 'Código incorrecto o expirado.'
        ]);
    }

    $user->update([
        'email_verified_at' => now(),
        'verification_code' => null
    ]);

    Auth::login($user);

    return redirect()->intended('/home')
                   ->with('success', '¡Cuenta verificada con éxito!');
}
}
