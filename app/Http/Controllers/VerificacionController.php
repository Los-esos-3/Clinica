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
            'code' => 'required|string'
        ]);

        $user = User::where('email', $request->email)
                    ->where('verification_code', $request->code)
                    ->first();

        if (!$user) {
            return back()->withErrors(['code' => 'Código incorrecto.']);
        }

        $user->is_verified = true;
        $user->verification_code = null;
        $user->save();

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Cuenta verificada con éxito.');
    }
}
