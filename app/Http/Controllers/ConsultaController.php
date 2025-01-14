<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Doctores;
use App\Models\Paciente;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    public function index()
    {
        $consultas = Consulta::with(['paciente', 'doctor'])->get();
      
        return view('consultas.index', compact('consultas'));
    }

    public function create(Request $request)
    {

        $paciente = Paciente::find($request->paciente_id); // Asegúrate de que estás obteniendo el paciente
        $medicos = Doctores::all(); // Obtener todos los médicos
        return view('consultas.create', compact('paciente','medicos'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'medico_id' => 'required|exists:doctores,id',
            'fecha_hora' => 'required|date',
            'motivo_consulta' => 'required|string',
            'diagnostico' => 'nullable|string',
            'tratamiento' => 'nullable|string',
            'receta_medica' => 'nullable|string',
            'indicaciones' => 'nullable|string',
            'pruebas_solicitadas' => 'nullable|string',
            'notas_adicionales' => 'nullable|string',
            'fecha_proxima_cita' => 'nullable|date',
            'estado' => 'required|in:Completada,Pendiente,Cancelada',
        ]);

        Consulta::create($validatedData);
        return redirect()->route('Pacientes.PacientesView')->with('success', 'Consulta creada con éxito.');
    }

    public function show($id)
    {
        $consulta = Consulta::with('medico')->findOrFail($id);
        return view('consultas.show', compact('consulta'));
    }

    public function edit($id)
    {
        $consulta = Consulta::findOrFail($id);
        $medicos = Doctores::all();
        return view('consultas.edit', compact('consulta', 'medicos'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'medico_id' => 'required|exists:doctores,id',
            'fecha_hora' => 'required|date',
            'motivo_consulta' => 'required|string',
            'diagnostico' => 'nullable|string',
            'tratamiento' => 'nullable|string',
            'receta_medica' => 'nullable|string',
            'indicaciones' => 'nullable|string',
            'pruebas_solicitadas' => 'nullable|string',
            'notas_adicionales' => 'nullable|string',
            'fecha_proxima_cita' => 'nullable|date',
            'estado' => 'required|in:Completada,Pendiente,Cancelada',
        ]);

        $consulta = Consulta::findOrFail($id);
        $consulta->update($validatedData);
        return redirect()->route('Pacientes.PacientesView')->with('success', 'Consulta actualizada con éxito.');
    }

    public function destroy($id)
    {
        $consulta = Consulta::findOrFail($id);
        $consulta->delete();
        return redirect()->route('Pacientes.PacientesView')->with('success', 'Consulta eliminada con éxito.');
    }
}
