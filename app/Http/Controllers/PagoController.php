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
use Illuminate\Support\Facades\Validator;

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

            Session::put('request_plan', $validated);

            return redirect()->route('evidencia.index');
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


    public function indexEvidencia(Request $request)
    {

        $planInfo = Session::get('request_plan');

        $registrationData = Session::get('registration_data');

        return view('pagos.evidencia')->with('registration');
    }

    public function storeEvidencia(Request $request)
    {
        $requestPlan = Session::get('request_plan');

        $user = Auth::user();

        // Validar los datos del formulario actual ($request)
        $validator = Validator::make($request->all(), [
            'ticket' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $requestInfo = $requestPlan;

        if (!$user->trial_used) {
            $referenciaPrueba = str_pad($user->id, 10, '0', STR_PAD_LEFT);
    
            Pago::create([
                'user_id' => $user->id,
                'plan' => 'Tiempo de Prueba',
                'precio' => 0.00,
                'referencia' => $referenciaPrueba,
                'fecha_generacion' => now(),
                'tipo_pago' => 'prueba', // Asignar explícitamente el valor
                'ticket' => 'null',
            ]);

            // Marcar el período de prueba como usado
            $user->update(['trial_used' => true]);
        }

        // $ticketPath = $request->file('ticket')->store('images', 'public');

         if ($request->hasFile('ticket')) {
            $imagen = $request->file('ticket');
            $ticketPath = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('images'), $ticketPath);
            $request['foto_perfil'] = $ticketPath;
        }



        // Crear el pago normal
        Pago::create([
            'user_id' => $user->id,
            'plan' => $requestInfo['plan'],
            'precio' => $requestInfo['precio'],
            'referencia' => $requestInfo['referencia'],
            'fecha_generacion' => $requestInfo['fecha'],
            'tipo_pago' => 'normal',
            'ticket' => $ticketPath, // Guardar la ruta del archivo
        ]);

        // Actualizar el usuario con el plan seleccionado
        $user->selected_plan = $requestInfo['plan'];
        $user->plan_price = $requestInfo['precio'];
        $user->assignRole('Admin');
        $user->save();

        DB::commit();

        return redirect()->route('dashboard')->with('success', 'Pago registrado exitosamente.');
    }
}
