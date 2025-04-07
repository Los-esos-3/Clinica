<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Doctores;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ConsultaController 
{
    public function index()
    {
        $consultas = Consulta::with(['paciente', 'doctor'])->paginate(25);
        return view('consultas.index', compact('consultas'));
    }

    public function create(Request $request)
    {

        $paciente = Paciente::find($request->paciente_id); // Asegúrate de que estás obteniendo el paciente
        // Filtrar doctores según el rol del usuario
    if (Auth::check() && Auth::user()->empresa_id) {
        $doctores = Doctores::where('empresa_id', Auth::user()->empresa_id)->get();
    } else {
        $doctores = Doctores::all(); // Obtener todos los doctores si no hay empresa
    }
        return view('consultas.create', compact('paciente','doctores'));
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
        $consulta = Consulta::with(['medico', 'paciente'])->findOrFail($id);
        $paciente = $consulta->paciente;
        $consultas = $paciente->consultas()->paginate(1);
        
        return view('consultas.show', compact('consulta', 'consultas', 'expedientes'));
    }

    public function edit($id)
{
    $consulta = Consulta::with('doctor')->findOrFail($id);
    $paciente = $consulta->paciente;

    // Filtrar doctores según el rol del usuario
    if (Auth::check() && Auth::user()->empresa_id) {
        $doctores = Doctores::where('empresa_id', Auth::user()->empresa_id)->get();
    } else {
        $doctores = Doctores::all(); // Obtener todos los doctores si no hay empresa
    }

    return view('consultas.edit', compact('consulta', 'paciente', 'doctores'));
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

        Log::info($request->all());

        $consulta = Consulta::findOrFail($id);
        $consulta->update($validatedData);

        $consulta->refresh();
        return redirect()->route('Pacientes.PacientesView')->with('success', 'Consulta actualizada con éxito.');
    }

    public function destroy($id)
    {
        $consulta = Consulta::findOrFail($id);
        $consulta->delete();
        return redirect()->route('Pacientes.PacientesView')->with('success', 'Consulta eliminada con éxito.');
    }
}
