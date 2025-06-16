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
use Illuminate\Support\Facades\Route;

class VerificacionController
{
    public function index(Request $request)
    {
        $this->enviarCodigo($request);

        return view('verificacion');
    }
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

        // Envío del correo al usuario que se está registrando
        Mail::to($request->email)->send(new CodigoVerificacionMail($codigo));
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
        if (
            $storedCode && $storedTimestamp &&
            (now()->timestamp - $storedTimestamp) < 1800 &&
            $request->codigo == $storedCode
        ) {

            if (!$registrationData) {
                return redirect()->route('register')
                    ->with('error', 'Los datos de registro no se encontraron. Intenta registrarte nuevamente.');
            }


            // Obtener los datos del formulario
            $requestData = $registrationData;

            $planDays = (int) $registrationData['plan_days']; 

        
            $planExpiresAt = now()->addDays($planDays);

            $user = User::create([
                'name' => $registrationData['name'],
                'email' => $registrationData['email'],
                'phone' => $registrationData['phone'],
                'password' => Hash::make($registrationData['password']),
                'comments' => $registrationData['comments'] ?? null,
                'registration_source' => 'web',
                'selected_plan' => $registrationData['selected_plan'],
                'plan_expires_at' => $planExpiresAt,
                'plan_price' =>$registrationData['plan_price'],
                'trial_ends_at' => now()->addDay(30),
                'trial_ended' => false
            ]);

             $user->assignRole('Admin'); 

            Auth::login($user); // Autenticación automática

            // Limpia la sesión
            Session::forget('codigo_verificacion');
            Session::forget('codigo_timestamp');
            Session::forget('registration_data');

               $requestData = $registrationData;
              Session::put('registration_data', $requestData);

             return redirect()->route('verificar.index', ['reload' => true])->with('reloaded', true)->with($requestData);
        }
        

        return back()->withErrors(['codigo' => 'El código es incorrecto o ha expirado.'])->withInput();
    }
}
