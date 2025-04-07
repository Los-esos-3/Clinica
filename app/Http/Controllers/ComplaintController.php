<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ComplaintReceived;

class ComplaintController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'complaint' => 'required|string|max:2000',
            'name' => 'nullable|string|max:100',
            'contact' => 'nullable|string|max:100',
            'anonymous' => 'nullable|boolean'
        ]);
        
        $data = [
            'name' => $request->anonymous ? 'Anónimo' : ($request->name ?? 'No proporcionado'),
            'contact' => $request->contact ?? 'No proporcionado',
            'complaint' => $request->complaint,
            'ip' => $request->ip(),
            'received_at' => now()->format('d/m/Y H:i:s')
        ];
        
        Mail::to([
            'agitokanoh657@gmail.com',
            'diurnovampiro6@gmail.com',
            'ig9682756@gmail.com',
        ])->send(new ComplaintReceived($data));
                
        return redirect()->route('contactenos.form')  // Usa el nombre correcto
        ->with('success', 'Tu queja ha sido enviada correctamente.');
    
    }
}