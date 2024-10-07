<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Expediente;


class ExpedientesController extends Controller
{
  public function index()
{
    $pacientes = Paciente::all();
    $expedientes = Expediente::with('paciente')->get();
    return view('Expedientes.ExpedientesIndex', compact('pacientes', 'expedientes'));
}


    public function create($pacienteId)
{
    $paciente = Paciente::findOrFail($pacienteId);
    return view('expedientes.create', compact('paciente'));
}

public function store(Request $request)
{
    $request->validate([
        'paciente_id' => 'required|exists:pacientes,id',
        'doctor' => 'required|string|max:255',
        'especialidad' => 'required|string|max:255',
        'diagnostico' => 'required|string',
        'tratamiento' => 'required|string',
        'antecedentes' => 'nullable|string',
        'familiar' => 'nullable|string|max:255',
        'famialiarnumero' => 'nullable|string|max:20',
        'proximacita' => 'nullable|date',
    ]);

    Expediente::create($request->all());

    return redirect()->route('expedientes.index'); // Redirigir a la lista de expedientes
}
}
