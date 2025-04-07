<?php

namespace App\Http\Controllers;

use App\Models\Secretarias;
use App\Models\User;
use App\Models\Paciente;
use App\Models\Secretaria;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class SecretariasDoctorController extends Controller
{
    public function index()
    {
        $doctor = Auth::user();

        // Obtener todas las secretarias disponibles en la misma empresa
        $usuarios = User::whereHas('roles', function ($query) {
            $query->where('name', 'Secretaria');
        })
            ->where('empresa_id', $doctor->empresa_id)
            ->whereDoesntHave('secretaria.doctor') // Excluir secretarias ya asignadas a un doctor
            ->get();

        // Obtener las secretarias asignadas al doctor actual
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

            // Asignar los pacientes del doctor a la secretaria
            $pacientesDoctor = Paciente::where('doctor_id', $doctor->doctor->id)
                ->whereNull('secretaria_id')
                ->get();

            foreach ($pacientesDoctor as $paciente) {
                $paciente->secretaria_id = $secretaria->id;
                $paciente->save();
            }

            // Asignar los pacientes de la secretaria al doctor
            $pacientesSecretaria = Paciente::where('secretaria_id', $secretaria->id)
                ->whereNull('doctor_id')
                ->get();

            foreach ($pacientesSecretaria as $paciente) {
                $paciente->doctor_id = $doctor->doctor->id;
                $paciente->save();
            }
        }

        return redirect()->route('Doctor.Secretaria')->with('success', 'Secretaria asignada correctamente.');
    }



    // public function desasignarSecretaria($id)
    // {
    //     $secretaria = Secretarias::findOrFail($id);

    //     // Verificar que la secretaria pertenezca al doctor actual
    //     if ($secretaria->doctor_id === Auth::user()->doctor->id) {
    //         // Obtener todos los pacientes relacionados con la secretaria
    //         $pacientesSecretaria = Paciente::where('secretaria_id', $secretaria->id)->get();

    //         // Desvincular el doctor y la secretaria de los pacientes
    //         foreach ($pacientesSecretaria as $paciente) {
    //             $paciente->doctor_id = null;
    //             $paciente->secretaria_id = null;
    //             $paciente->save();
    //         }

    //         // Limpiar la relación de la secretaria con el doctor
    //         $secretaria->doctor_id = null;
    //         $secretaria->save();
    //     }

    //     return redirect()->route('Doctor.Secretaria')->with('success', 'Secretaria desasignada correctamente.');
    // }

    // public function CheckSecretaria($id)
    // {
    //     $secretaria = Secretarias::findOrFail($id);

    //     if ($secretaria->doctor_id === Auth::user()->doctor->id) {
    //     }
    // }

    public function desasignarSecretaria($id)
    {
        $secretaria = Secretarias::findOrFail($id);

        // Verificar que la secretaria pertenezca al doctor actual
        if ($secretaria->doctor_id === Auth::user()->doctor->id) {
            // Obtener todos los pacientes relacionados con la secretaria
            $pacientesSecretaria = Paciente::where('secretaria_id', $secretaria->id)->get();

            // Desvincular el doctor y la secretaria de los pacientes
            foreach ($pacientesSecretaria as $paciente) {
                $paciente->doctor_id = null;
                $paciente->secretaria_id = null;
                $paciente->save();
            }

            // Limpiar la relación de la secretaria con el doctor
            $secretaria->doctor_id = null;
            $secretaria->save();
        }

        return redirect()->route('Doctor.Secretaria')->with('success', 'Secretaria desasignada correctamente.');
    }
}
