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
    public function PacientesView(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');

        // Construir la consulta inicial
        $query = Paciente::query();

        if ($user->hasRole('Doctor')) {
            if ($user->doctor) {
                $query->where('doctor_id', $user->doctor->id)
                    ->orWhere('user_id', $user->id);
            } else {
                $query->whereNull('id'); // Lista vacía
            }
        } elseif ($user->hasRole('Secretaria')) {
            if ($user->secretaria) {
                $query->where('secretaria_id', $user->secretaria->id)
                    ->orWhere('user_id', $user->id);
            } else {
                $query->whereNull('id'); // Lista vacía
            }
        } else {
            $query->whereNull('id'); // Lista vacía
        }

        // Aplicar filtro de búsqueda si existe
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'LIKE', "%{$search}%");
            });
        }

        // Paginar los resultados
        $pacientes = $query->paginate(9);

        // Mensaje si no hay resultados
        $noResultsMessage = $pacientes->isEmpty() ? "No se encontró ningún paciente con ese nombre." : null;

        return view('Pacientes.PacientesIndex', compact('pacientes', 'noResultsMessage', 'search'));
    }


    public function create()
    {
        return view('pacientes.create');
    }

    public function store(Request $request)
    {
        $this->authorize('crear pacientes');

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

        $user = Auth::user();

        // Asignar el user_id del usuario autenticado
        $validatedData['user_id'] = $user->id;

        // Verificar si el usuario es un doctor o una secretaria
        if ($user->hasRole('Doctor')) {
            // Si es un doctor, asignar el paciente al doctor
            $doctor = $user->doctor;
            if ($doctor) {
                $validatedData['doctor_id'] = $doctor->id;
            } else {
                // Si el doctor no tiene un registro en la tabla doctores, asignar null
                $validatedData['doctor_id'] = null;
            }
            // El doctor no tiene una secretaria asociada
            $validatedData['secretaria_id'] = null;
        } elseif ($user->hasRole('Secretaria')) {
            // Si es una secretaria, obtener el doctor que la asignó (si existe)
            $secretaria = $user->secretaria;
            if ($secretaria && $secretaria->doctor) {
                $validatedData['doctor_id'] = $secretaria->doctor->id;
            } else {
                // Si la secretaria no tiene un doctor asignado, asignar null
                $validatedData['doctor_id'] = null;
            }
            // Asignar la secretaria al paciente
            $validatedData['secretaria_id'] = $secretaria ? $secretaria->id : null;
        } else {
            // Si no es doctor ni secretaria, redirigir con un error
            return redirect()->back()->with('error', 'No tienes permisos para crear pacientes.');
        }

        // Manejo de la imagen
        if ($request->hasFile('foto_perfil')) {
            $imagen = $request->file('foto_perfil');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('images'), $nombreImagen);
            $validatedData['foto_perfil'] = $nombreImagen;
        }

        // Crear el paciente
        Paciente::create($validatedData);

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
