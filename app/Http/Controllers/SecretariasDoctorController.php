<?php

namespace App\Http\Controllers;

use App\Models\Secretarias;
use App\Models\User;
use App\Models\Paciente;
use App\Models\Secretaria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
    public function asignarSecretaria(Request $request)
    {
        $request->validate([
            'secretaria_id' => 'required|exists:users,id',
        ]);

        $doctor = Auth::user();
        $secretaria = Secretarias::where('user_id', $request->secretaria_id)->first();

        if ($secretaria) {
            // Asignar la secretaria al doctor
            $secretaria->doctor_id = $doctor->doctor->id;
            $secretaria->save();

            // Caso 1: Asociar los pacientes creados por la secretaria antes de la asignación al doctor
            $pacientesSecretaria = Paciente::where('secretaria_id', $secretaria->id)
                ->whereNull('doctor_id') // Solo pacientes sin doctor asignado
                ->get();

            foreach ($pacientesSecretaria as $paciente) {
                $paciente->doctor_id = $doctor->doctor->id;
                $paciente->save();
            }

            // Caso 2: Asociar los pacientes creados por el doctor antes de la asignación a la secretaria
            $pacientesDoctor = Paciente::where('doctor_id', $doctor->doctor->id)
                ->whereNull('secretaria_id') // Solo pacientes sin secretaria asignada
                ->get();

            foreach ($pacientesDoctor as $paciente) {
                $paciente->secretaria_id = $secretaria->id;
                $paciente->save();
            }
        }

        return redirect()->route('Doctor.Secretaria')->with('success', 'Secretaria asignada correctamente.');
    }

    // Desasignar una secretaria

    public function desasignarSecretaria($id)
    {
        // Obtener la secretaria
        $secretaria = Secretarias::findOrFail($id);
    
        // Verificar si la secretaria está asignada al doctor actual
        if ($secretaria->doctor_id === Auth::user()->doctor->id) {
            // Caso 1: Eliminar el doctor_id de los pacientes creados por la secretaria
            $pacientesSecretaria = Paciente::where('secretaria_id', $secretaria->id)->get();
    
            foreach ($pacientesSecretaria as $paciente) {
                $paciente->doctor_id = null; // Eliminar el doctor_id
                $paciente->secretaria_id = null; // También eliminamos la secretaria_id
                $paciente->save();
            }
    
            // Caso 2: Eliminar el secretaria_id de los pacientes creados por el doctor y asignados a la secretaria
            $pacientesDoctor = Paciente::where('doctor_id', Auth::user()->doctor->id)
                ->where('secretaria_id', $secretaria->id) // Solo pacientes con esta secretaria
                ->get();
    
            foreach ($pacientesDoctor as $paciente) {
                $paciente->secretaria_id = null; // Eliminar el secretaria_id
                $paciente->save();
            }
    
            // Desasignar la secretaria (eliminar el doctor_id de la secretaria)
            $secretaria->doctor_id = null;
            $secretaria->save();
        }
    
        return redirect()->route('Doctor.Secretaria')->with('success', 'Secretaria desasignada correctamente.');
    }
}
