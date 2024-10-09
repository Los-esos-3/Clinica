<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Expediente;


    class ExpedientesController extends Controller
{
    public function index()
    {
        $expedientes = Expediente::with('paciente')->get();
        return view('Expedientes.ExpedientesIndex', compact('expedientes'));
    }


    public function create()
    {
        $pacientes = Paciente::all();
        return view('Expedientes.Create', compact('pacientes'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'doctor' => 'required|string',
            'especialidad' => 'required|string',
            'diagnostico' => 'required|string',
            'tratamiento' => 'required|string',
            'antecedentes' => 'nullable|string',
            'familiar_a_cargo' => 'nullable|string',
            'numero_familiar' => 'nullable|string',
            'proxima_cita' => 'nullable|date',
            'fecha_registro' => 'required|date',
        ]);

        Expediente::create($request->all());

        return redirect()->route('Expedientes.index')->with('success', 'Expediente creado con éxito.');
    }
    public function edit($id)
    {
        $expediente = Expediente::findOrFail($id);
        return view('Expedientes.Edit', compact('expediente'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'doctor' => 'required|string|max:255',
            'especialidad' => 'required|string|max:255',
            'diagnostico' => 'required|string',
            'tratamiento' => 'required|string',
            'antecedentes' => 'nullable|string',
            'familiar' => 'nullable|string|max:255',
            'familiarnumero' => 'nullable|string|max:20',
            'proximacita' => 'nullable|date',
        ]);

        $expediente = Expediente::findOrFail($id);
        $expediente->update($request->all());

        return redirect()->route('Expedientes.index');
    }

    public function destroy($id)
    {
        $expediente = Expediente::findOrFail($id);
        $expediente->delete();

        return redirect()->route('Expedientes.index')->with('success', 'Expediente eliminado con éxito.');
    }

    public function getCitas()
    {
        $citas = Expediente::whereNotNull('proximacita')
            ->select('proximacita as start', 'paciente_id', 'doctor')
            ->with('paciente')
            ->get()
            ->map(function ($cita) {
                return [
                    'title' => $cita->paciente->nombre,
                    'start' => $cita->start,
                    'doctor' => $cita->doctor,
                    'allDay' => true,
                ];
            });

        return response()->json($citas);
    }
}
