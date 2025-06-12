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

        // Si viene con ?reload=true, actualiza datos antes de mostrar la vista
        if (request('reload')) {
          return redirect()->route('verificar.index');
        }


        return view('pagos.verificar');
    }

    public function store(Request $request)
    {


        try {
            // Limpiar y preparar los datos
            $request->merge([
                'precio' => str_replace(['$', ','], '', $request->precio),
                'fecha' => Carbon::parse($request->fecha)->format('Y-m-d H:i:s'),
            ]);



            // Validar los datos
            $validated = $request->validate([
                'plan' => 'required|string',
                'precio' => 'required|numeric',
                'referencia' => 'required|string|unique:pagos,referencia',
                'fecha' => 'required|date',
            ]);



            DB::beginTransaction();

            // Crear el pago
            $pago = Pago::create([
                'user_id' => Auth::id(),
                'plan' => $validated['plan'],
                'precio' => $validated['precio'],
                'referencia' => $validated['referencia'],
                'fecha_generacion' => $validated['fecha'],
            ]);



            // Actualizar el usuario con el plan seleccionado
            $user = Auth::user();
            $user->selected_plan = $validated['plan'];
            $user->plan_price = $validated['precio'];
            $user->save();



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
