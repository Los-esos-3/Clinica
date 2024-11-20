<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Expediente;
use App\Models\Doctores;
use Illuminate\Support\Facades\Log; 
use Carbon\Carbon;

class ExpedientesController extends Controller
{ 
    public function index()
    {
        // Cargar expedientes con la relación de paciente y doctor
        $expedientes = Expediente::with(['paciente', 'doctor'])->get();
        return view('Expedientes.ExpedientesIndex', compact('expedientes'));
    }

    public function admin()
    {
        $expedientes = Expediente::with(['paciente', 'doctor'])->get();
        return view('Expedientes.ExpedienteIndexAdmin', compact('expedientes'));
    }

    public function create(Request $request)
    {
        $pacientes = Paciente::all(); 
        $doctores = Doctores::all();
        $especialidad = null;

        if ($request->has('doctor_id')) {
            $doctor = Doctores::find($request->doctor_id);
            if ($doctor) {
                $especialidad = $doctor->especialidad_medica;
            }
        }

        return view('Expedientes.Create', compact('pacientes', 'doctores', 'especialidad'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'doctor_id' => 'required|exists:doctores,id',
            'especialidad' => 'required|string',
            'diagnostico' => 'required|string',
            'tratamiento' => 'required|string',
            'antecedentes' => 'nullable|string',
            'familiar_a_cargo' => 'nullable|string',
            'numero_familiar' => 'nullable|string',
            'proxima_cita' => 'nullable|date',
            'hora_proxima_cita' => 'nullable|date_format:H:i',
            'fecha_registro' => 'required|date',
        ]);

        $validatedData['fecha_registro'] = Carbon::parse($validatedData['fecha_registro'])->format('Y-m-d');
        Expediente::create($validatedData);

        return redirect()->route('Pacientes.PacientesView')->with('success', 'Expediente creado con éxito.');
    }

    public function show($id)
    {
        // Obtener el expediente específico junto con el doctor y el paciente
        $expediente = Expediente::with(['paciente', 'doctor'])->findOrFail($id);
        return view('Expedientes.Show', compact('expediente'));
    }

    public function edit($id)
    {
        $expediente = Expediente::findOrFail($id);
        $doctores = Doctores::all();
        return view('Expedientes.Edit', compact('expediente', 'doctores'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctores,id',
            'especialidad' => 'required|string|max:255',
            'diagnostico' => 'required|string',
            'tratamiento' => 'required|string',
            'antecedentes' => 'nullable|string',
            'familiar_a_cargo' => 'nullable|string|max:255',
            'numero_familiar' => 'nullable|string|max:20',
            'proxima_cita' => 'nullable|date',
            'hora_proxima_cita' => 'nullable|date_format:H:i',
        ]);

        $expediente = Expediente::findOrFail($id);
        $expediente->update($request->all());

        return redirect()->route('Expedientes.index')->with('success', 'Expediente actualizado con éxito.');
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
            ->select('proxima_cita', 'hora_proxima_cita', 'paciente_id', 'doctor_id')
            ->with(['paciente:id,nombre', 'doctor:id,nombre'])
            ->get();

        $formattedCitas = $citas->map(function ($expediente) {
            $fechaHora = Carbon::parse($expediente->proxima_cita . ' ' . $expediente->hora_proxima_cita);
            return [
                'title' => $expediente->paciente->nombre . ' - Dr. ' . $expediente->doctor->nombre,
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
