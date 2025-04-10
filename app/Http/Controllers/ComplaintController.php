<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactReceived;
use Illuminate\Support\Facades\Log;

class ComplaintController   
{
    public function submit(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:20',
            'message' => 'required|string|max:2000'
        ]);

        // Preparar los datos para el correo
        $data = [
            'name' => $request->name . ' ' . $request->lastname,
            'contact' => $request->email . ' | Tel: ' . $request->phone,
            'message' => $request->message,
            'received_at' => now()->format('d/m/Y H:i:s')
        ];

        try {
            // Enviar el correo a los destinatarios
            Mail::to('agitokanoh657@gmail.com')
                ->cc([
                    'diurnovampiro6@gmail.com',
                    'ig9682756@gmail.com'
                ])
                ->send(new \App\Mail\ComplaintReceived($data));
                
            // Redirigir con mensaje de éxito
            return redirect()->back()
                ->with('success', 'Tu mensaje ha sido enviado correctamente.');
        } catch (\Exception $e) {
            // Registrar el error en los logs
            Log::error('Error al enviar el correo: ' . $e->getMessage());

            // Redirigir con mensaje de error
            return redirect()->back()
                ->with('error', 'Hubo un problema al enviar el mensaje. Por favor intenta nuevamente.');
        }
    }
}
