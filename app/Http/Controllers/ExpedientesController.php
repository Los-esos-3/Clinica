<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Expediente;
use Illuminate\Support\Facades\Log; 
use Carbon\Carbon;

    class ExpedientesController extends Controller
{ 
    public function index()
    {
        $expedientes = Expediente::with('paciente')->get();
        $pacientes = Paciente::all();
        $pacientes = Paciente::with(relations: 'expediente')->get();
        return view('Expedientes.ExpedientesIndex', compact('expedientes','pacientes'));
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
            'hora_proxima_cita' => 'nullable|date_format:H:i', // Añade esta línea
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
            'hora_proxima_cita' => 'nullable|date_format:H:i', // Añade esta línea
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
        $citas = Expediente::whereNotNull('proxima_cita')
            ->select('proxima_cita', 'hora_proxima_cita', 'paciente_id', 'doctor')
            ->with('paciente:id,nombre')
            ->get();

        $formattedCitas = $citas->map(function ($expediente) {
            $fechaHora = Carbon::parse($expediente->proxima_cita . ' ' . $expediente->hora_proxima_cita);
            return [
                'title' => $expediente->paciente->nombre . ' - Dr. ' . $expediente->doctor,
                'start' => $fechaHora->format('Y-m-d\TH:i:s'),
                'allDay' => false,
                'extendedProps' => [
                    'horaFormateada' => $fechaHora->format('h:i A')
                ]
            ];
        });

        return response()->json($formattedCitas);
    }
}
