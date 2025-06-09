<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\CodigoVerificacionMail;

class VerificacionController 
{
    public function enviarCodigo(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Genera código aleatorio
        $codigo = mt_rand(100000, 999999); // Usando mt_rand para mejor aleatoriedad

        // Guarda en sesión con timestamp
        Session::put('codigo_verificacion', $codigo);
        Session::put('codigo_timestamp', now()->timestamp);
        Session::put('email_verificacion', $request->email);

        // Log para depuración
        Log::info('Nuevo código generado', [
            'email' => $request->email,
            'codigo' => $codigo,
            'timestamp' => now()->timestamp
        ]);

        // Envío del correo al usuario que se está registrando
        Mail::to($request->email)->send(new CodigoVerificacionMail($codigo));


        // Redirige a la vista para ingresar el código
        return redirect()->route('verificacion')->with('status', 'Código enviado a tu correo.');
    }

    public function verificarCodigo(Request $request)
    {
        $request->validate([
            'codigo' => 'required|numeric',
        ]);
    
        $storedCode = Session::get('codigo_verificacion');
        $storedTimestamp = Session::get('codigo_timestamp');
        $registrationData = Session::get('registration_data');
    
        // Verifica si el código es válido y no ha expirado
        if ($storedCode && $storedTimestamp &&
            (now()->timestamp - $storedTimestamp) < 1800 &&
            $request->codigo == $storedCode) {
    
            if (!$registrationData) {
                return redirect()->route('register')
                    ->with('error', 'Los datos de registro no se encontraron. Intenta registrarte nuevamente.');
            }
    
            try {
                // Crear el usuario
                $planExpiresAt = now()->addDays($registrationData['plan_days']);
    
                $user = User::create([
                    'name' => $registrationData['name'],
                    'email' => $registrationData['email'],
                    'phone' => $registrationData['phone'],
                    'password' => Hash::make($registrationData['password']),
                    'comments' => $registrationData['comments'] ?? null,
                    'selected_plan' => $registrationData['selected_plan'],
                    'plan_expires_at' => $planExpiresAt,
                    'trial_ends_at' => $planExpiresAt,
                    'trial_ended' => false
                ]);
    
                $user->assignRole('Admin');
    
                Auth::login($user);
    
                // Limpia la sesión
                Session::forget(['codigo_verificacion', 'codigo_timestamp', 'registration_data']);
    
                return redirect()->route('dashboard')
                    ->with('success', '¡Registro exitoso! Tu plan ' . ucfirst($registrationData['selected_plan']) . ' está activo hasta ' . $planExpiresAt->format('d/m/Y'));
            } catch (\Exception $e) {
                Log::error('Error al crear usuario: ' . $e->getMessage());
                return redirect()->route('register')
                    ->with('error', 'Hubo un error al crear tu cuenta. Por favor, intenta nuevamente.');
            }
        }
    
        return back()
            ->withErrors(['codigo' => 'El código es incorrecto o ha expirado.'])
            ->withInput();
    }
}
