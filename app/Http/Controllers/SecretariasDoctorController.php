<?php

namespace App\Http\Controllers;

use App\Models\Secretarias;
use App\Models\User;
use App\Models\Secretaria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SecretariasDoctorController extends Controller
{
    // Mostrar el formulario para asociar secretarias
    public function index()
    {
        $doctor = Auth::user();

        // Obtener las secretarias disponibles de la misma empresa que el doctor
        $usuarios = User::whereHas('roles', function ($query) {
            $query->where('name', 'Secretaria');
        })
            ->where('empresa_id', $doctor->empresa_id)
            ->get();

        // Obtener las secretarias asignadas al doctor
        $secretariasAsignadas = $doctor->doctor->secretarias;

        return view('SecretariaDeDoctor.SecretariaDoctor', compact('usuarios', 'secretariasAsignadas'));
    }

    // Asignar una secretaria al doctor
    public function asignarSecretaria(Request $request)
    {
        $request->validate([
            'secretaria_id' => 'required|exists:users,id',
        ]);

        $doctor = Auth::user();
        $secretaria = Secretarias::where('user_id', $request->secretaria_id)->first();

        if ($secretaria) {
            $secretaria->doctor_id = $doctor->doctor->id;
            $secretaria->save();
        }

        return redirect()->route('Doctor.Secretaria')->with('success', 'Secretaria asignada correctamente.');
    }

    // Desasignar una secretaria
    public function desasignarSecretaria($id)
    {
        $secretaria = Secretarias::findOrFail($id);

        if ($secretaria->doctor_id === Auth::user()->doctor->id) {
            $secretaria->doctor_id = null;
            $secretaria->save();
        }

        return redirect()->route('Doctor.Secretaria')->with('success', 'Secretaria desasignada correctamente.');
    }
}
