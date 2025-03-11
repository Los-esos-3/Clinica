<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Paciente;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ClinicaController extends Controller
{

    use HasRoles;
    use AuthorizesRequests;
    // public function PacientesView(Request $request)
    // {
    //     $this->authorize('ver pacientes');
    //     $query = $request->input('search');

    //     if ($query) {
    //         $pacientes = Paciente::where('user_id', Auth::id())
    //             ->where('nombre', 'LIKE', "%{$query}%")
    //             ->paginate(20);
    //     } else {
    //         $pacientes = Paciente::where('user_id', Auth::id())->paginate(9);
    //     }


    //     $noResultsMessage = $pacientes->isEmpty() ? "No se encontró ningún paciente con ese nombre." : null;

    //     return view('Pacientes.PacientesIndex', compact('pacientes',  'noResultsMessage'));
    // }

    public function PacientesView(Request $request)
    {
        $user = Auth::user();
        $query = $request->input('search');

        if ($user->hasRole('Doctor')) {
            // Obtener los pacientes del doctor y los creados por sus secretarias
            $pacientes = Paciente::where('doctor_id', $user->doctor->id);
        } elseif ($user->hasRole('Secretaria')) {
            // Obtener los pacientes asociados al doctor que asignó a la secretaria
            $secretaria = $user->secretaria;
            if (!$secretaria || !$secretaria->doctor) {
                // Si la secretaria no tiene un doctor asignado, mostrar una lista vacía
                $pacientes = Paciente::where('id', -1); // Lista vacía
            } else {
                $pacientes = Paciente::where('doctor_id', $secretaria->doctor->id);
            }
        } else {
            // Si no es doctor ni secretaria, mostrar una lista vacía
            $pacientes = Paciente::where('id', -1); // Lista vacía
        }

        // Filtrar pacientes si hay una búsqueda
        if ($query) {
            $pacientes->where('nombre', 'LIKE', "%{$query}%");
        }

        // Paginar los resultados
        $pacientes = $pacientes->paginate(9);

        $noResultsMessage = $pacientes->isEmpty() ? "No se encontró ningún paciente con ese nombre." : null;

        return view('Pacientes.PacientesIndex', compact('pacientes', 'noResultsMessage'));
    }

    public function create()
    {
        return view('pacientes.create');
    }

    public function store(Request $request)
    {
        $this->authorize('crear pacientes');
        Log::info('Entro al metodo Store');

        $validatedData = $request->validate([
            'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nombre' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'fecha_nacimiento' => 'nullable|date',
            'edad' => 'nullable|integer|min:0',
            'direccion' => 'nullable|string|max:255',
            'genero' => 'nullable|string|max:10',
            'estado_civil' => 'nullable|string|max:20',
            'tipo_sangre' => 'nullable|string|max:10',
            'ocupacion' => 'nullable|string|max:100',
        ]);

        Log::info('Tomo las validacion', $request->all());

        $user = Auth::user();

        // Verificar si el usuario es un doctor o una secretaria
        if ($user->hasRole('Doctor')) {
            // Si es un doctor, asignar el paciente al doctor
            $doctor = $user->doctor;
            $validatedData['doctor_id'] = $doctor->id;
            $validatedData['secretaria_id'] = null; // El doctor no tiene una secretaria asociada
        } elseif ($user->hasRole('Secretaria')) {
            // Si es una secretaria, obtener el doctor que la asignó
            $secretaria = $user->secretaria;
            if (!$secretaria || !$secretaria->doctor) {
                Log::info('La secretaria no tiene un doctor asignado.');
                return redirect()->back()->with('error', 'No tienes un doctor asignado. Contacta al administrador.');
            }
            $doctor = $secretaria->doctor;
            $validatedData['doctor_id'] = $doctor->id;
            $validatedData['secretaria_id'] = $secretaria->id;
        } else {
            // Si no es doctor ni secretaria, redirigir con un error
            return redirect()->back()->with('error', 'No tienes permisos para crear pacientes.');
        }

        Log::info('Asigno el doctor y la secretaria al paciente');

        // Asignar el user_id del usuario autenticado
        $validatedData['user_id'] = $user->id;

        // Manejo de la imagen
        if ($request->hasFile('foto_perfil')) {
            $imagen = $request->file('foto_perfil');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('images'), $nombreImagen);
            $validatedData['foto_perfil'] = $nombreImagen;
        }

        Log::info('Capturo la img');

        // Crear el paciente
        Paciente::create($validatedData);

        Log::info('Creo al paciente');

        return redirect()->route('Pacientes.PacientesView')->with('success', 'Paciente creado correctamente.');
    }
    public function edit($id)
    {
        $this->authorize('editar pacientes');
        $paciente = Paciente::findOrFail($id); // Obtener el paciente por ID
        return view('pacientes.edit', compact('paciente')); // Retornar la vista para editar el paciente
    }

    public function show($id)
    {
        // Lógica para obtener el paciente
        $paciente = Paciente::find($id);

        // Aquí deberías obtener las consultas y expedientes paginados  
        $consultas = $paciente->consultas()->paginate(1);  // Paginación de consultas
        $expedientes = $paciente->expedientes()->paginate(1);  // Paginación de expedientes

        dd($consultas, $expedientes);

        // Pasar el paciente, consultas y expedientes a la vista
        return view('PacientesView.PacienteDoctor', compact('paciente', 'consultas', 'expedientes'));
    }

    public function update(Request $request, $id)
    {
        $this->authorize('editar pacientes');
        $request->validate([
            'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nombre' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'fecha_nacimiento' => 'nullable|date',
            'edad' => 'nullable|integer|min:0',
            'direccion' => 'nullable|string|max:255',
            'genero' => 'nullable|string|max:10',
            'estado_civil' => 'nullable|string|max:20',
            'tipo_sangre' => 'nullable|string|max:10',
            'ocupacion' => 'nullable|string|max:100',
        ]);

        $paciente = Paciente::findOrFail($id);
        $paciente->update($request->all());

        return redirect()->route('Pacientes.PacientesView');
    }

    public function destroy($id)
    {
        $this->authorize('eliminar pacientes');

        $paciente = Paciente::findOrFail($id);

        // Eliminar las consultas relacionadas
        $paciente->consultas()->delete();

        // Eliminar el expediente relacionado si existe
        if ($paciente->expediente) {
            $paciente->expediente->delete();
        }

        // Eliminar el paciente
        $paciente->delete();

        return redirect()->route('Pacientes.PacientesView')->with('success', 'Paciente y sus datos eliminados correctamente.');
    }
}
