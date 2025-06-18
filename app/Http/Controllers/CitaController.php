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
        $citas = collect(); // Inicializar como colección vacía
        $pacientes = collect(); // Inicializar como colección vacía
        $doctores = collect(); // Inicializar como colección vacía
        $doctorId = null;

        // Obtener doctores de la misma empresa (para roles como Admin)
        if ($user->hasRole('Admin') && $user->empresa_id) {
            $doctores = Doctores::whereHas('user', function ($query) use ($user) {
                $query->where('empresa_id', $user->empresa_id);
            })->get();
        } else {
            // Si no hay empresa asignada, mostrar una lista vacía
            $doctores = collect();
        }

        // Lógica para el rol de Admin
        if ($user->hasRole('Admin')) {
            // Verificar si el administrador tiene una empresa asignada
            if ($user->empresa_id) {
                // Obtener IDs de doctores de la misma empresa
                $doctoresEmpresa = User::where('empresa_id', $user->empresa_id)
                    ->whereHas('roles', function ($q) {
                        $q->where('name', 'Doctor');
                    })
                    ->with('doctor')
                    ->get()
                    ->pluck('doctor.id')
                    ->filter()
                    ->toArray();

                // Obtener IDs de secretarias de la misma empresa
                $secretariasEmpresa = User::where('empresa_id', $user->empresa_id)
                    ->whereHas('roles', function ($q) {
                        $q->where('name', 'Secretaria');
                    })
                    ->with('secretaria')
                    ->get()
                    ->pluck('secretaria.id')
                    ->filter()
                    ->toArray();

                // Consulta optimizada para citas
                $citas = Cita::where(function ($query) use ($doctoresEmpresa, $secretariasEmpresa) {
                    // Citas donde el doctor pertenece a la empresa
                    $query->whereIn('doctor_id', $doctoresEmpresa);

                    // O citas donde el paciente fue creado por un doctor o secretaria de la empresa
                    $query->orWhereHas('paciente', function ($q) use ($doctoresEmpresa, $secretariasEmpresa) {
                        $q->whereIn('doctor_id', $doctoresEmpresa)
                            ->orWhereIn('secretaria_id', $secretariasEmpresa);
                    });
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
                            'doctor_id' => $cita->doctor_id,
                            'paciente_id' => $cita->paciente_id
                        ];
                    });

                // Obtener pacientes de la empresa
                $pacientes = Paciente::where(function ($query) use ($doctoresEmpresa, $secretariasEmpresa) {
                    $query->whereIn('doctor_id', $doctoresEmpresa)
                        ->orWhereIn('secretaria_id', $secretariasEmpresa);
                })
                    ->get();
            }

            return view('dashboard', compact('doctores', 'pacientes', 'citas', 'doctorId'));
        }

        // Lógica para el rol de Doctor
        if ($user->hasRole('Doctor')) {
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

            $pacientes = Paciente::where('doctor_id', $user->doctor->id)->get();

            return view('Secretaria.Dashboard', compact('doctores', 'pacientes', 'citas', 'doctorId'));
        }

        // Lógica para el rol de Secretaria
        if ($user->hasRole('Secretaria')) {
            $secretaria = Secretarias::where('user_id', $user->id)->first();

            if ($secretaria) {
                $citas = Cita::whereHas('paciente', function ($query) use ($secretaria) {
                    $query->where('secretaria_id', $secretaria->id);
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

                $pacientes = Paciente::where('secretaria_id', $secretaria->id)->get();

                $isAdmin = Auth::check() && Auth::user()->hasRole('Admin');

                return view('Secretaria.Dashboard', compact('doctores', 'pacientes', 'citas', 'doctorId', 'isAdmin'));
            }

            return redirect()->back()->with('error', 'No se encontraron citas para esta secretaria.');
        }

        $isAdmin = Auth::check() && Auth::user()->hasRole('Admin');

        return view('dashboard', [
            'doctores' => $doctores,
            'pacientes' => $pacientes,
            'citas' => $citas->toArray(), // Convertir a array para FullCalendar
            'doctorId' => $doctorId,
            'isAdmin'
        ]);
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
