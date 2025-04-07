<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User; // Importación añadida
use App\Mail\VerificationCodeMail;

class RegisterController  // Asumo que es el nombre de tu controlador
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'verification_code' => rand(100000, 999999),
        ]);

        try {
            Mail::to($user->email)->send(new VerificationCodeMail($user));
            
            return redirect()->route('verificar.email.form', ['email' => $user->email])
            ->with('verification_sent', true)
            ->with('registered_email', $user->email)
                            ->with('success', 'Te hemos enviado un código de verificación a tu correo.');
        } catch (\Exception $e) {
            // Opcional: eliminar el usuario si el correo no se pudo enviar
            $user->delete();
            
            return back()->with('error', 'No pudimos enviar el correo de verificación. Por favor intenta nuevamente.');
        }
    }
}
