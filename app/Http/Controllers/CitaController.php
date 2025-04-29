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

class CitaController
{
    use AuthorizesRequests;
    use hasRoles;

    public function index()
{
    $this->authorize('ver dashboard');

    $user = Auth::user();
    $citas = [];
    $pacientes = [];
    $doctores = [];
    $doctorId = null;

    // Obtener todos los doctores (para roles como Admin/Root)
    $doctores = Doctores::all();

    // Lógica para el rol de Admin
    if ($user->hasRole('Admin')) {
        // Verificar si el administrador tiene una empresa asignada
        if ($user->empresa_id) {
            // Obtener todos los usuarios (doctores y secretarias) de la misma empresa
            $usuariosEmpresa = User::where('empresa_id', $user->empresa_id)->pluck('id');

            // Filtrar citas cuyo doctor o paciente pertenezca a la misma empresa
            $citas = Cita::whereIn('doctor_id', $usuariosEmpresa)
                ->orWhereIn('paciente_id', function ($query) use ($usuariosEmpresa) {
                    $query->select('id')
                        ->from('pacientes')
                        ->whereIn('doctor_id', $usuariosEmpresa)
                        ->orWhereIn('secretaria_id', $usuariosEmpresa);
                })
                ->with(['paciente', 'doctor'])
                ->get()
                ->map(function ($cita) {
                    return [
                        'id' => $cita->id,
                        'doctor' => $cita->doctor?->nombre_completo ?? 'Sin Doctor',
                        'title' => $cita->paciente?->nombre ?? 'Sin Paciente',
                        'start' => $cita->fecha . 'T' . $cita->hora_inicio,
                        'end' => $cita->fecha . 'T' . $cita->hora_fin,
                        'motivo' => $cita->motivo,
                    ];
                });

            // Obtener todos los pacientes de la misma empresa
            $pacientes = Paciente::whereIn('doctor_id', $usuariosEmpresa)
                ->orWhereIn('secretaria_id', $usuariosEmpresa)
                ->get();
        } else {
            // Si el administrador no tiene empresa, no mostrar citas ni pacientes
            $citas = [];
            $pacientes = [];
        }

        // Redirigir al dashboard con las citas y pacientes filtrados
        return view('dashboard', compact('doctores', 'pacientes', 'citas','doctorId'));
    }

    // Lógica para el rol de Doctor
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

        // Redirigir al dashboard del doctor
        return view('Secretaria.Dashboard', compact('doctores', 'pacientes', 'citas','doctorId'));
    }

    // Lógica para el rol de Secretaria
    if ($user->hasRole('Secretaria')) {
        // Obtener la secretaria asociada al usuario
        $secretaria = Secretarias::where('user_id', $user->id)->first();

        if ($secretaria) {
            // Obtener las citas de la secretaria
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
                        'doctor' => $cita->doctor?->nombre_completo ?? 'Sin Doctor',
                        'title' => $cita->paciente?->nombre ?? 'Sin Paciente',
                        'start' => $cita->fecha . 'T' . $cita->hora_inicio,
                        'end' => $cita->fecha . 'T' . $cita->hora_fin,
                        'motivo' => $cita->motivo,
                    ];
                });

            // Obtener los pacientes asignados a la secretaria
            $pacientes = Paciente::where('secretaria_id', $secretaria->id)->get();

            // Redirigir al dashboard de la secretaria
            return view('Secretaria.dashboard', compact('doctores', 'pacientes', 'citas', 'doctorId'));
        } else {
            // Si no hay secretaria asociada, mostrar mensaje de error
            return redirect()->back()->with('error', 'No se encontraron citas para esta secretaria.');
        }
    }

    // Por defecto, redirigir al dashboard
    return view('dashboard', compact('doctores', 'pacientes', 'citas'));
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
