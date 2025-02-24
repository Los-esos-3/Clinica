<?php

namespace App\Http\Controllers;

use App\Models\Doctores; // Asegúrate de que el modelo Doctor esté correctamente importado
use App\Models\Paciente; // Asegúrate de que el modelo Paciente esté correctamente importado
use App\Models\Cita; // Asegúrate de que el modelo Cita esté correctamente importado
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CitaController extends Controller
{
    public function index()
    {
        $doctores = [];
        $user = Auth::user();

        // Obtener solo los pacientes creados por el usuario actual
        $pacientes = Paciente::where('user_id', $user->id)->get();

        $citas = Cita::with(['paciente', 'doctor'])->get()->map(function ($cita) {
            return [
                'id' => $cita->id,
                'doctor' => $cita->doctor->nombre_completo,
                'title' => $cita->paciente->nombre,
                'start' => $cita->fecha . 'T' . $cita->hora_inicio,
                'end' => $cita->fecha . 'T' . $cita->hora_fin,
                'motivo' => $cita->motivo,
            ];
        });

        if ($user->hasRole('Admin')) {
            $doctores = Doctores::all(); // Obtener todos los doctores
            return view('dashboard', compact('doctores', 'pacientes', 'citas'));
        } else {
            if ($user->empresa_id) {
                $doctores = Doctores::where('empresa_id', $user->empresa_id)->get();
            }
            return view('Secretaria.dashboard', compact('doctores', 'pacientes', 'citas'));
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
