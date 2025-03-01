<?php

namespace App\Http\Controllers;

use App\Models\Doctores;
use App\Models\User;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class DoctoresController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Obtener todos los doctores con sus relaciones
        $query = Doctores::with('user');

        // Filtrar por empresa si el usuario autenticado tiene empresa_id
        if (Auth::check() && Auth::user()->empresa_id) {
            $query->whereHas('user', function ($q) {
                $q->where('empresa_id', Auth::user()->empresa_id);
            });
        }

        // Aplicar búsqueda si existe
        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('nombre_completo', 'like', '%' . $search . '%')
                    ->orWhere('especialidad_medica', 'like', '%' . $search . '%');
            });
        }

        // Paginar los resultados
        $doctores = $query->paginate(10);

        return view('doctores.index', compact('doctores', 'search'));
    }
    public function create()
    {
        // Si el usuario está autenticado y tiene empresa_id, mostrar solo esa empresa
        if (Auth::check() && Auth::user()->empresa_id) {
            $empresas = Empresa::where('id', Auth::user()->empresa_id)->get();
        } else {
            // Si no, mostrar todas las empresas
            $empresas = Empresa::all();
        }

        return view('doctores.create', compact('empresas'));
    }
    public function asignarRolDoctor($userId)
    {
        // Obtener el usuario
        $user = User::findOrFail($userId);

        // Asignar el rol de "Doctor"
        $doctorRole = Role::where('name', 'Doctor')->first();
        $user->assignRole($doctorRole);

        // Verificar si ya existe un registro en la tabla doctores para este usuario
        $doctorExistente = Doctores::where('user_id', $user->id)->first();

        if (!$doctorExistente) {
            // Crear un registro en la tabla doctores
            Doctores::create([
                'user_id' => $user->id,
                'nombre_completo' => $user->name, 
                'email' => $user->email,
            ]);
        }

        return redirect()->route('doctores.index')
            ->with('success', 'Rol de Doctor asignado y registro creado exitosamente.');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required|in:Masculino,Femenino,Otro',
            'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'telefono' => 'nullable|string|max:15',
            'email' => 'nullable|email|unique:users', // Validar email único en users
            'password' => 'nullable|min:8', // Validar contraseña
            'domicilio' => 'nullable|string',
            'nacionalidad' => 'required|string',
            'especialidad_medica' => 'required|string',
            'universidad' => 'nullable|string',
            'titulo' => 'nullable|string',
            'año_graduacion' => 'nullable|integer',
            'años_experiencia' => 'nullable|integer',
            'contacto_emergencia_nombre' => 'nullable|string',
            'contacto_emergencia_relacion' => 'nullable|string',
            'contacto_emergencia_telefono' => 'nullable|string',
            'area_departamento' => 'nullable|string',
            'empresa_id' => 'required|exists:empresas,id',
        ]);

        // Crear el usuario
        $user = User::create([
            'nombre_completo' => $validated['nombre_completo'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'empresa_id' => $validated['empresa_id'],
        ]);

        // Guardar la foto de perfil si se proporciona
        if ($request->hasFile('foto_perfil')) {
            $imagen = $request->file('foto_perfil');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('images'), $nombreImagen);
            $validated['foto_perfil'] = $nombreImagen;
        }

        // Crear el registro en la tabla doctores
        Doctores::create([
            'user_id' => $user->id,
            'fecha_nacimiento' => $validated['fecha_nacimiento'],
            'genero' => $validated['genero'],
            'foto_perfil' => $validated['foto_perfil'] ?? null,
            'telefono' => $validated['telefono'],
            'domicilio' => $validated['domicilio'],
            'nacionalidad' => $validated['nacionalidad'],
            'especialidad_medica' => $validated['especialidad_medica'],
            'universidad' => $validated['universidad'],
            'titulo' => $validated['titulo'],
            'año_graduacion' => $validated['año_graduacion'],
            'años_experiencia' => $validated['años_experiencia'],
            'contacto_emergencia_nombre' => $validated['contacto_emergencia_nombre'],
            'contacto_emergencia_relacion' => $validated['contacto_emergencia_relacion'],
            'contacto_emergencia_telefono' => $validated['contacto_emergencia_telefono'],
            'area_departamento' => $validated['area_departamento'],
        ]);

        return redirect()->route('doctores.index')
            ->with('success', 'Doctor registrado exitosamente.');
    }

    public function edit($id)
    {
        $doctor = Doctores::findOrFail($id);
        // Si el usuario está autenticado y tiene empresa_id, mostrar solo esa empresa
        if (Auth::check() && Auth::user()->empresa_id) {
            $empresas = Empresa::where('id', Auth::user()->empresa_id)->get();
        } else {
            // Si no, mostrar todas las empresas
            $empresas = Empresa::all();
        }
        return view('doctores.edit', compact('doctor', 'empresas'));
    }

    public function update(Request $request, $id)
    {
        $doctor = Doctores::findOrFail($id);

        $validated = $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required|in:Masculino,Femenino,Otro',
            'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'telefono' => 'nullable|string|max:15',
            'email' => 'nullable|email|unique:users,email,' . $doctor->user_id, // Validar email único en users
            'domicilio' => 'nullable|string',
            'nacionalidad' => 'nullable|string',
            'especialidad_medica' => 'nullable|string',
            'universidad' => 'nullable|string',
            'titulo' => 'nullable|string',
            'año_graduacion' => 'nullable|integer',
            'años_experiencia' => 'nullable|integer',
            'contacto_emergencia_nombre' => 'nullable|string',
            'contacto_emergencia_relacion' => 'nullable|string',
            'contacto_emergencia_telefono' => 'nullable|string',
            'area_departamento' => 'nullable|string',
            'empresa_id' => 'required|exists:empresas,id',
        ]);

        // Actualizar el usuario asociado al doctor
        $user = User::findOrFail($doctor->user_id);
        $user->update([
            'nombre_completo' => $validated['nombre_completo'],
            'email' => $validated['email'],
            'empresa_id' => $validated['empresa_id'],
        ]);

        // Actualizar la foto de perfil si se proporciona
        if ($request->hasFile('foto_perfil')) {
            // Eliminar foto anterior si existe
            if ($doctor->foto_perfil) {
                Storage::disk('public')->delete($doctor->foto_perfil);
            }
            $path = $request->file('foto_perfil')->store('doctores', 'public');
            $validated['foto_perfil'] = $path;
        }

        // Actualizar el registro en la tabla doctores
        $doctor->update($validated);

        return redirect()->route('doctores.index')
            ->with('success', 'Información del doctor actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $doctor = Doctores::findOrFail($id);
        $user = User::findOrFail($doctor->user_id);

        // Eliminar el usuario asociado al doctor
        $user->delete();

        // Eliminar el doctor
        $doctor->delete();

        return redirect()->route('doctores.index')->with('success', 'Doctor eliminado correctamente');
    }
}
