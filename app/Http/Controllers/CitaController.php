<?php

namespace App\Http\Controllers;

use App\Models\Doctores;
use App\Models\Paciente;
use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use App\Models\Secretarias;

class CitaController extends Controller
{
    use AuthorizesRequests;
    use hasRoles;

    public function index()
    {
        $this->authorize('ver dashboard');

        $user = Auth::user();
        $citas = [];
        $pacientes = []; // Inicializar la variable $pacientes

        $doctores = Doctores::all();
        $pacientes = Paciente::all();

        // Obtener el ID del doctor si el usuario tiene el rol de Doctor
        $doctorId = null;


        if ($user->hasRole('Doctor')) {
            // Si el usuario es doctor, obtener su propio ID
            $doctorId = $user->doctor->id;
        } elseif ($user->hasRole('Secretaria')) {
            // Si el usuario es secretaria, obtener el ID del doctor asignado
            $secretaria = Secretarias::where('user_id', $user->id)->first();
            $doctorId = $secretaria?->doctor_id;
        }


        if ($user->hasRole('Doctor')) {
            // Obtener las citas del doctor
            $citas = Cita::where('doctor_id', $user->doctor->id)
                ->with(['paciente', 'doctor'])
                ->get()
                ->map(function ($cita) {
                    return [
                        'id' => $cita->id,
                        'doctor' => $cita->doctor->nombre_completo,
                        'title' => $cita->paciente->nombre,
                        'start' => $cita->fecha . 'T' . $cita->hora_inicio,
                        'end' => $cita->fecha . 'T' . $cita->hora_fin,
                        'motivo' => $cita->motivo,
                    ];
                });

            // Obtener los pacientes asignados al doctor
            $pacientes = Paciente::where('doctor_id', $user->doctor->id)->get();
        } elseif ($user->hasRole('Secretaria')) {
            // Obtener las citas de la secretaria
            $secretaria = Secretarias::where('user_id', $user->id)->first();
            $citas = Cita::whereIn('paciente_id', function ($query) use ($secretaria) {
                $query->select('id')
                    ->from('pacientes')
                    ->where('secretaria_id', $secretaria->id);
            })
                ->with(['paciente', 'doctor'])
                ->get()
                ->map(function ($cita) {
                    return [
                        'id' => $cita->id,
                        'doctor' => $cita->doctor->nombre_completo,
                        'title' => $cita->paciente->nombre,
                        'start' => $cita->fecha . 'T' . $cita->hora_inicio,
                        'end' => $cita->fecha . 'T' . $cita->hora_fin,
                        'motivo' => $cita->motivo,
                    ];
                });

            // Obtener los pacientes asignados a la secretaria
            $pacientes = Paciente::where('secretaria_id', $secretaria->id)->get();
        }

        // Verificar si el usuario es Root o Admin
        if ($user->hasAnyRole('Root', 'Admin')) {
            $doctores = Doctores::all();
            $pacientes = Paciente::all(); // Todos los pacientes para Root/Admin
            return view('dashboard', compact('doctores', 'pacientes', 'citas'));
        } else {
            // Si el usuario tiene una empresa asignada
            if ($user->empresa_id) {
                $doctores = Doctores::where('empresa_id', $user->empresa_id)->get();
            }
            return view('Secretaria.dashboard', compact('doctores', 'pacientes', 'citas', 'doctorId'));
        }
    }

    public function getDoctores()
    {
        $doctores = Doctores::all();
        return response()->json($doctores);
    }

    public function getPacientes()
    {
        $pacientes = Paciente::all();
        $citas = Cita::all();

        return view('dashboard', compact('doctores', 'pacientes', 'citas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
            'paciente_id' => 'required|exists:pacientes,id',
            'doctor_id' => 'required|exists:doctores,id',
            'motivo' => 'required|string|max:255',
        ]);

        $cita = Cita::create($request->all());

        return response()->json([
            'message' => 'Cita creada correctamente',
            'cita' => [
                'id' => $cita->id,
                'title' => $cita->paciente->nombre,
                'start' => $cita->fecha . 'T' . $cita->hora_inicio,
                'end' => $cita->fecha . 'T' . $cita->hora_fin,
                'doctor' => $cita->doctor->nombre_completo,
                'motivo' => $cita->motivo,
            ],
        ]);
    }


    // En el controlador, el método destroy
    public function destroy($id)
    {
        $cita = Cita::find($id);

        if (!$cita) {
            return redirect()->route('citas.index')->with('error', 'Cita no encontrada.');
        }

        $cita->delete();

        return redirect()->route('citas.index')->with('success', 'Cita eliminada exitosamente.');
    }

    public function show($id)
    {
        $cita = Cita::find($id);
        if (!$cita) {
            return redirect()->route('citas.index')->with('error', 'Cita no encontrada.');
        }

        return view('citas.show', compact('cita'));
    }
}
