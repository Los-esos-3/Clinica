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
        $citas = collect();
        $pacientes = collect();
        $doctores = collect();
        $doctorId = null;

        // Obtener doctores de la misma empresa (para roles como Admin)
        if ($user->hasRole('Admin') && $user->empresa_id) {
            $doctores = Doctores::whereHas('user', function ($query) use ($user) {
                $query->where('empresa_id', $user->empresa_id);
            })->get();
        }

        // Lógica para el rol de Admin
        if ($user->hasRole('Admin')) {
            if ($user->empresa_id) {
                // Obtener IDs de doctores y secretarias de la empresa
                $doctoresIds = User::where('empresa_id', $user->empresa_id)
                    ->whereHas('roles', fn($q) => $q->where('name', 'Doctor'))
                    ->with('doctor')
                    ->get()
                    ->pluck('doctor.id')
                    ->filter()
                    ->toArray();

                $secretariasIds = User::where('empresa_id', $user->empresa_id)
                    ->whereHas('roles', fn($q) => $q->where('name', 'Secretaria'))
                    ->with('secretaria')
                    ->get()
                    ->pluck('secretaria.id')
                    ->filter()
                    ->toArray();

                // Consulta para citas
                $citas = Cita::whereIn('doctor_id', $doctoresIds)
                    ->orWhereHas('paciente', function ($q) use ($doctoresIds, $secretariasIds) {
                        $q->whereIn('doctor_id', $doctoresIds)
                            ->orWhereIn('secretaria_id', $secretariasIds);
                    })
                    ->with(['paciente', 'doctor'])
                    ->get()
                    ->map(fn($cita) => $this->formatCita($cita));

                // Consulta para pacientes
                $pacientes = Paciente::whereIn('doctor_id', $doctoresIds)
                    ->orWhereIn('secretaria_id', $secretariasIds)
                    ->get();
            }
        }
        // Lógica para el rol de Doctor
        elseif ($user->hasRole('Doctor')) {
            $doctor = $user->doctor;
            $doctorId = $doctor->id;

            // Obtener doctores de la misma empresa para el select
            $doctores = Doctores::whereHas('user', function ($query) use ($user) {
                $query->where('empresa_id', $user->empresa_id);
            })->get();

            // Citas del doctor
            $citas = Cita::where('doctor_id', $doctor->id)
                ->with(['paciente', 'doctor'])
                ->get()
                ->map(fn($cita) => $this->formatCita($cita));

            // Pacientes del doctor
            $pacientes = Paciente::where('doctor_id', $doctor->id)->get();

            return view('Secretaria.Dashboard', compact('doctores', 'pacientes', 'citas', 'doctorId'));
        }
        // Lógica para el rol de Secretaria
        elseif ($user->hasRole('Secretaria')) {
            $secretaria = $user->secretaria;

            // Obtener el doctor asociado (si existe)
            $doctorAsociado = $secretaria->doctor; // Asumiendo que hay una relación

            // Obtener doctores de la misma empresa para el select
            $doctores = Doctores::whereHas('user', function ($query) use ($user) {
                $query->where('empresa_id', $user->empresa_id);
            })->get();

            // Citas: las de la secretaria + las del doctor asociado
            $citasQuery = Cita::whereHas('paciente', function ($q) use ($secretaria, $doctorAsociado) {
                $q->where('secretaria_id', $secretaria->id);

                if ($doctorAsociado) {
                    $q->orWhere('doctor_id', $doctorAsociado->id);
                }
            });

            // Si hay doctor asociado, agregar también citas donde él es el doctor
            if ($doctorAsociado) {
                $citasQuery->orWhere('doctor_id', $doctorAsociado->id);
            }

            $citas = $citasQuery->with(['paciente', 'doctor'])
                ->get()
                ->map(fn($cita) => $this->formatCita($cita));

            // Pacientes: los de la secretaria + los del doctor asociado
            $pacientesQuery = Paciente::where('secretaria_id', $secretaria->id);

            if ($doctorAsociado) {
                $pacientesQuery->orWhere('doctor_id', $doctorAsociado->id);
            }

            $pacientes = $pacientesQuery->get();
            return view('Secretaria.Dashboard', compact('doctores', 'pacientes', 'citas', 'doctorId'));
        }

        return view('dashboard', compact('doctores', 'pacientes', 'citas', 'doctorId'));
    }

    // Función auxiliar para formatear citas
    private function formatCita($cita)
    {
        return [
            'id' => $cita->id,
            'doctor' => $cita->doctor?->nombre_completo ?? 'Sin Doctor',
            'title' => $cita->paciente?->nombre ?? 'Sin Paciente',
            'start' => $cita->fecha . 'T' . $cita->hora_inicio,
            'end' => $cita->fecha . 'T' . $cita->hora_fin,
            'motivo' => $cita->motivo,
            'doctor_id' => $cita->doctor_id,
            'paciente_id' => $cita->paciente_id
        ];
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
        // Validación más robusta
        $validated = $request->validate([
            'fecha' => 'required|date|after_or_equal:today',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'paciente_id' => [
                'required',
                'exists:pacientes,id',
                function ($attribute, $value, $fail) use ($request) {
                    // Verificar que el paciente pertenezca al doctor
                    $paciente = Paciente::find($value);
                    if ($paciente && $paciente->doctor_id != $request->doctor_id) {
                        $fail('El paciente seleccionado no pertenece a este doctor.');
                    }
                }
            ],
            'doctor_id' => 'required|exists:doctores,id',
            'motivo' => 'required|string|max:255',
        ]);

        try {
            // Crear la cita
            $cita = Cita::create([
                'fecha' => $validated['fecha'],
                'hora_inicio' => $validated['hora_inicio'],
                'hora_fin' => $validated['hora_fin'],
                'paciente_id' => $validated['paciente_id'],
                'doctor_id' => $validated['doctor_id'],
                'motivo' => $validated['motivo'],
                'estado' => 'programada' // Asegurar un estado por defecto
            ]);

            // Cargar relaciones para la respuesta
            $cita->load('paciente', 'doctor');

            return response()->json([
                'success' => true,
                'message' => 'Cita creada correctamente',
                'cita' => [
                    'id' => $cita->id,
                    'title' => $cita->paciente->nombre,
                    'start' => $cita->fecha . 'T' . $cita->hora_inicio,
                    'end' => $cita->fecha . 'T' . $cita->hora_fin,
                    'doctor' => $cita->doctor->nombre_completo,
                    'motivo' => $cita->motivo,
                    'extendedProps' => [
                        'doctor' => $cita->doctor->nombre_completo,
                        'motivo' => $cita->motivo
                    ]
                ],
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la cita: ' . $e->getMessage()
            ], 500);
        }
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
