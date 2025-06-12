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
        Log::info('Iniciando proceso de guardado de pago');
        
        try {
            // Limpiar y preparar los datos
            $request->merge([
                'precio' => str_replace(['$', ','], '', $request->precio),
                'fecha' => Carbon::parse($request->fecha)->format('Y-m-d H:i:s'),
            ]);

            Log::info('Datos preparados:', $request->all());

            // Validar los datos
            $validated = $request->validate([
                'plan' => 'required|string',
                'precio' => 'required|numeric',
                'referencia' => 'required|string|unique:pagos,referencia',
                'fecha' => 'required|date',
            ]);

            Log::info('Datos validados correctamente');

            DB::beginTransaction();
            
            // Crear el pago
            $pago = Pago::create([
                'user_id' => Auth::id(),
                'plan' => $validated['plan'],
                'precio' => $validated['precio'],
                'referencia' => $validated['referencia'],
                'fecha_generacion' => $validated['fecha'],
            ]);

            Log::info('Pago creado exitosamente:', ['pago_id' => $pago->id]);

            // Actualizar el usuario con el plan seleccionado
            $user = Auth::user();
            $user->selected_plan = $validated['plan'];
            $user->plan_price = $validated['precio'];
            $user->save();

            Log::info('Usuario actualizado con el plan');

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pago registrado correctamente',
                'redirect' => route('dashboard')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al guardar el pago: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Error al procesar el pago: ' . $e->getMessage()
            ], 500);
        }
    }
}