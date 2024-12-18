<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Doctores;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    public function index()
    {
        $consultas = Consulta::with('medico')->get();
        return view('consultas.index', compact('consultas'));
    }

    public function create()
    {
        $medicos = Doctores::all();
        return view('consultas.create', compact('medicos'));
    }

    public function store(Request $request)
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

        Consulta::create($validatedData);
        return redirect()->route('consultas.index')->with('success', 'Consulta creada con éxito.');
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
        return redirect()->route('consultas.index')->with('success', 'Consulta actualizada con éxito.');
    }

    public function destroy($id)
    {
        $consulta = Consulta::findOrFail($id);
        $consulta->delete();
        return redirect()->route('consultas.index')->with('success', 'Consulta eliminada con éxito.');
    }
}
