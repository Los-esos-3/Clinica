<?php

namespace App\Http\Controllers;

use App\Models\Doctores; // Asegúrate de que el modelo Doctor esté correctamente importado
use App\Models\Paciente; // Asegúrate de que el modelo Paciente esté correctamente importado
use App\Models\Cita; // Asegúrate de que el modelo Cita esté correctamente importado
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index()
    {
        $doctores = Doctores::all(); // Obtener todos los doctores
        $pacientes = Paciente::all(); // Obtener todos los pacientes

        return view('Secretaria.Dashboard', compact('doctores', 'pacientes')); // Pasar a la vista
    }

    public function getDoctores()
    {
        $doctores = Doctor::all();
        return response()->json($doctores);
    }

    public function getPacientes()
    {
        $pacientes = Paciente::all();
        return response()->json($pacientes);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'fecha' => 'required|date',
                'hora_inicio' => 'required',
                'hora_fin' => 'required',
                'doctor_id' => 'required|exists:doctores,id',
                'paciente_id' => 'required|exists:pacientes,id',
                'motivo' => 'required|string',
            ]);

            $cita = Cita::create([
                'fecha' => $request->fecha,
                'hora_inicio' => $request->hora_inicio,
                'hora_fin' => $request->hora_fin,
                'doctor_id' => $request->doctor_id,
                'paciente_id' => $request->paciente_id,
                'motivo' => $request->motivo,
            ]);

            // return response()->json(['success' => 'Cita creada exitosamente.']); // Comentado
        } catch (\Exception $e) {
            // return response()->json(['error' => 'Error al crear la cita: ' . $e->getMessage()], 500); // Comentado
        }
    }
}
