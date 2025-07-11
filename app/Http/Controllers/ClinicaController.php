<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Paciente;
use App\Models\Doctores;
use App\Models\Secretarias;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ClinicaController
{

    use HasRoles;
    use AuthorizesRequests;
    public function PacientesView(Request $request)
    {
        $user = Auth::user();
        $search = trim(strtolower($request->input('search')));

        // Construir la consulta inicial
        $query = Paciente::with(['user', 'doctor', 'secretaria']);

        // Filtrar pacientes según el rol del usuario autenticado
        if ($user->hasRole('Admin')) {
            // Verificar si el administrador tiene una empresa asignada
            if ($user->empresa_id) {
                // Obtener todos los usuarios (doctores y secretarias) de la misma empresa
                $usuariosEmpresa = User::where('empresa_id', $user->empresa_id)->pluck('id');

                // Filtrar pacientes cuyo doctor, secretaria o usuario pertenezca a la misma empresa
                $query->where(function ($q) use ($usuariosEmpresa) {
                    $q->whereIn('doctor_id', $usuariosEmpresa)
                        ->orWhereIn('secretaria_id', $usuariosEmpresa)
                        ->orWhereIn('user_id', $usuariosEmpresa);
                });
            } else {
                // Si el administrador no tiene empresa, no mostrar ningún paciente
                $query->whereNull('id');
            }
        } elseif ($user->hasRole('Doctor')) {
            // Filtrar pacientes para doctores
            if ($user->doctor) {
                $query->where(function ($q) use ($user) {
                    $q->where('doctor_id', $user->doctor->id)
                        ->orWhere('user_id', $user->id);
                });
            } else {
                $query->whereNull('id'); // Lista vacía si el doctor no está asociado
            }
        } elseif ($user->hasRole('Secretaria')) {
            // Filtrar pacientes para secretarias
            if ($user->secretaria) {
                $query->where(function ($q) use ($user) {
                    $q->where('secretaria_id', $user->secretaria->id)
                        ->orWhere('user_id', $user->id);
                });
            } else {
                $query->whereNull('id'); // Lista vacía si la secretaria no está asociada
            }
        } else {
            // Lista vacía para otros roles
            $query->whereNull('id');
        }

        // Aplicar búsqueda si existe un término
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(nombre) LIKE ?', ['%' . strtolower($search) . '%'])
                    ->orWhere('telefono', 'like', '%' . $search . '%')
                    ->orWhere('direccion', 'like', '%' . $search . '%')
                    ->orWhere('ocupacion', 'like', '%' . $search . '%');
            });
        }

        // Paginar los resultados
        $pacientes = $query->paginate(9);

        return view('Pacientes.PacientesIndex', compact('pacientes', 'search'));
    }


    public function create()
    {
        return view('Pacientes.Create');
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

        if ($user->hasRole('Doctor')) {
            $doctor = $user->doctor;
            if ($doctor) {
                $validatedData['doctor_id'] = $doctor->id;
                
                // Buscar la secretaria asociada a este doctor
                $secretaria = Secretarias::where('doctor_id', $doctor->id)->first();
                $validatedData['secretaria_id'] = $secretaria ? $secretaria->id : null;
            }
        } elseif ($user->hasRole('Secretaria')) {
            $secretaria = $user->secretaria;
            if ($secretaria) {
                $validatedData['secretaria_id'] = $secretaria->id;
                $validatedData['doctor_id'] = $secretaria->doctor_id;
            }
        } else {
            return redirect()->back()->with('error', 'No tienes permisos para crear pacientes.');
        }

        
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
        return view('Pacientes.Edit', compact('paciente')); // Retornar la vista para editar el paciente
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

        $paciente = Paciente::findOrFail($id);
        
        if ($request->hasFile('foto_perfil')) {
            // Eliminar la imagen anterior si existe
            if ($paciente->foto_perfil && file_exists(public_path('images/' . $paciente->foto_perfil))) {
                unlink(public_path('images/' . $paciente->foto_perfil));
            }
            
            $imagen = $request->file('foto_perfil');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('images'), $nombreImagen);
            $validatedData['foto_perfil'] = $nombreImagen;
        }

        $paciente->update($validatedData);

        return redirect()->route('Pacientes.PacientesView')->with('success', 'Paciente actualizado correctamente.');
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
