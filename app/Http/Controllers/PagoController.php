<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class PagoController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function verificar()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return view('pagos.verificar');
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'message' => 'No autenticado. Por favor inicia sesión.'
            ], 401);
        }

        $request->validate([
            'plan' => 'required|string',
            'precio' => 'required|numeric',
            'referencia' => 'required|string|unique:pagos,referencia',
            'fecha' => 'required|date'
        ]);

        try {
            DB::beginTransaction();

            $pago = Pago::create([
                'user_id' => Auth::id(),
                'plan' => $request->plan,
                'precio' => $request->precio,
                'referencia' => $request->referencia,
                'fecha_generacion' => Carbon::parse($request->fecha)
            ]);

            // Actualizar el estado del usuario
            $user = Auth::user();
            $user->update([
                'plan_activo' => true,
                'plan_actual' => $request->plan,
                'fecha_activacion' => now()
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pago guardado correctamente',
                'pago' => $pago,
                'redirect' => route('dashboard')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error al guardar el pago',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
