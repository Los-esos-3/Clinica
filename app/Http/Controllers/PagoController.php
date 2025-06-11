<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class PagoController 
{
    public function index()
    {
        $registrationData = Session::get('registration_data');
        
        if (!$registrationData) {
            return redirect()->route('register')->with('error', 'No se encontraron datos de registro.');
        }
        
        return view('pagos.verificar', compact('registrationData'));
    }

    public function store(Request $request)
    {

        Log::info('Entro al metodo');
        // Limpiar y preparar los datos
        $request->merge([
            'precio' => str_replace(['$', ','], '', $request->precio),
            'fecha' => Carbon::parse($request->fecha)->format('Y-m-d H:i:s'),
        ]);

        Log::info('Termino de terminar la convercion de precio y fecha');

        // Validar los datos
        $validated = $request->validate([
            'plan' => 'required|string',
            'precio' => 'required|numeric',
            'referencia' => 'required|string|unique:pagos,referencia',
            'fecha' => 'required|date',
        ]);

        Log::info('Termino las validaciones con exito');

        try {

            Log::info('inicio el Try');
            
            // Crear el pago
            $pago = Pago::create([
                'user_id' => Auth::id(),
                'plan' => $validated['plan'],
                'precio' => $validated['precio'],
                'referencia' => $validated['referencia'],
                'fecha_generacion' => $validated['fecha'],
            ]);
            Log::info('creo el pago');

            // Redirigir con mensaje de éxito
            return redirect()->route('dashboard')
                ->with('success', 'Pago registrado correctamente. Referencia: ' . $validated['referencia']);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al guardar el pago: ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Error al procesar el pago: ' . $e->getMessage());
        }
    }
}