<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Empresa;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Doctores;
use Illuminate\Support\Facades\Auth;
use App\Models\Secretarias;
use App\Models\Personal;

class PersonalController
{

    public function index(Request $request)
    {
        $user = Auth::user();
        $search = trim(strtolower($request->input('search')));

        // Iniciar la consulta base con relaciones
        $query = Personal::with('user', 'empresa');

        // Filtrar por empresa si el usuario tiene empresa_id
        if ($user->empresa_id) {
            $query->where('empresa_id', $user->empresa_id);
        } else {
            $query->where('id', 0); // Condición imposible para devolver una lista vacía
        }
        // Aplicar búsqueda si existe
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(nombre) LIKE ?', ['%' . strtolower($search) . '%'])
                    ->orWhere('correo', 'LIKE', '%' . $search . '%')
                    ->orWhere('rol', 'LIKE', '%' . $search . '%');
            });
        }

        // Finalmente aplicar paginación
        $Personal = $query->paginate(9);

        return view('Personal.index', compact('Personal', 'search'));
    }


    public function create()
    {
        // Filtrar solo los roles permitidos
        $allowedRoles = ['Doctor', 'Secretaria', 'Admin'];
        $roles = Role::whereIn('name', $allowedRoles)->get();
        return view('Personal.create', compact('roles'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validar como imagen
            'email' => 'required|string|email|max:255|unique:users,email', // Validar correo electrónico
            'tel' => 'nullable|string|max:15', // Validar teléfono
            'password' => 'required|string|min:8|confirmed', // Validar contraseña
            'rol' => 'required|exists:roles,name',
        ]);


        try {
            // Crear el usuario
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['tel'],
                'password' => Hash::make($validated['password']),
                'empresa_id' => Auth::user()->empresa_id,
                'trial_ends_at' => Auth::user()->trial_ends_at,
                'registration_source' => 'admin',
            ]);

            // Asignar el rol al usuario
            $user->assignRole($validated['rol']);

            // Guardar la foto de perfil si existe
            $nombreImagen = null;
                
        if ($request->hasFile('foto_perfil')) {
            $imagen = $request->file('foto_perfil');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('images'), $nombreImagen);
            $validatedData['foto_perfil'] = $nombreImagen;
        }

            // Crear el personal
            $personal = Personal::create([
                'nombre' => $validated['name'],
                'foto_perfil' => $nombreImagen,
                'user_id' => $user->id,
                'correo' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'tel' => $validated['tel'] ?? null,
                'rol' => $validated['rol'],
                'empresa_id' => Auth::user()->empresa_id,
            ]);

            // Crear registro en la tabla correspondiente (doctor o secretaria)
            if ($validated['rol'] === 'Doctor') {
                Doctores::create([
                    'personal_id' => $personal->id,
                    'foto_perfil' => $nombreImagen,
                    'especialidad' => 'General',
                    'user_id' => $user->id,
                    'email' => $validated['email'],
                    'nombre_completo' => $validated['name'],
                    'empresa_id' => Auth::user()->empresa_id,
                ]);
            } elseif ($validated['rol'] === 'Secretaria') {
                Secretarias::create([
                    'personal_id' => $personal->id,
                    'foto_perfil' => $nombreImagen,
                    'user_id' => $user->id,
                    'nombre_completo' => $validated['name'],
                    'email' => $validated['email'],
                    'empresa_id' => Auth::user()->empresa_id,
                ]);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Error de validación: ' . $e->getMessage());
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        return redirect()->route('Personal.index')->with('success', 'personal creado exitosamente.');
    }

    public function edit(Personal $personal, $id)
    {
        // Obtener los roles permitidos
        $allowedRoles = ['Doctor', 'Secretaria', 'Admin'];
        $roles = Role::whereIn('name', $allowedRoles)->get();
        $personal = Personal::findOrFail($id);

        return view('Personal.edit', compact('personal', 'roles'));
    }

    public function update(Request $request, Personal $personal, $id)
    {
        $personal = Personal::findOrFail($id);

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'email' => 'required|string|email|max:255|unique:users,email,' . $personal->user_id,
                'tel' => 'nullable|string|max:15',
                'password' => 'nullable|string|min:8|confirmed',
                'rol' => 'required|exists:roles,name',
            ]);

            // Actualizar el usuario asociado
            $user = User::find($personal->user_id);

            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'] ? Hash::make($validated['password']) : $user->password,
            ]);

            // Obtener el rol anterior para comparar
            $oldRole = $user->getRoleNames()->first();

            // Actualizar el rol del usuario
            $user->syncRoles([$validated['rol']]);

            $nombreImagen = $personal->foto_perfil;
                    
        if ($request->hasFile('foto_perfil')) {
            $imagen = $request->file('foto_perfil');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName();
            $imagen->move(public_path('images'), $nombreImagen);
            $validatedData['foto_perfil'] = $nombreImagen;
        }




            // Actualizar el personal
            $personal->update([
                'nombre' => $validated['name'],
                'correo' => $validated['email'],
                'foto_perfil' => $nombreImagen,
                'tel' => $validated['tel'] ?? null,
                'rol' => $validated['rol'],
            ]);

            // Manejo de roles específicos (Doctor/Secretaria)
            if ($validated['rol'] !== $oldRole) {
                // Si el rol cambió, eliminar registros antiguos
                if ($oldRole === 'Doctor') {
                    Doctores::where('personal_id', $personal->id)->delete();
                } elseif ($oldRole === 'Secretaria') {
                    Secretarias::where('personal_id', $personal->id)->delete();
                }
            }

            // Crear o actualizar registro según el nuevo rol
            if ($validated['rol'] === 'Doctor') {
                $doctor = Doctores::firstOrNew(['personal_id' => $personal->id]);
                $doctor->fill([
                    'nombre_completo' => $validated['name'],
                    'foto_perfil' => $nombreImagen,
                    'email' => $personal['correo'],
                    'empresa_id' => Auth::user()->empresa_id,
                    'user_id' => $user->id,
                ])->save();
            } elseif ($validated['rol'] === 'Secretaria') {
                $secretaria = Secretarias::firstOrNew(['personal_id' => $personal->id]);
                $secretaria->fill([
                    'nombre_completo' => $validated['name'],
                    'email' => $personal['correo'],
                    'foto_perfil' => $nombreImagen,
                    'empresa_id' => Auth::user()->empresa_id,
                    'user_id' => $user->id,
                ])->save();
            } else {
                // Para otros roles (Admin), eliminar registros específicos si existen
                Doctores::where('personal_id', $personal->id)->delete();
                Secretarias::where('personal_id', $personal->id)->delete();
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Error de validación: ' . $e->getMessage());
            return redirect()->back()->withErrors($e->errors())->withInput();
        }


        return redirect()->route('Personal.index')->with('success', 'personal actualizado exitosamente.');
    }

    public function destroy(Personal $personal, $id)
    {
        $personal = Personal::findOrFail($id);

        // Eliminar registros relacionados en las tablas doctores o secretarias
        if ($personal->rol === 'Doctor') {
            Doctores::where('personal_id', $personal->id)->delete();
        } elseif ($personal->rol === 'Secretaria') {
            Secretarias::where('personal_id', $personal->id)->delete();
        }

        // Eliminar el personal
        $personal->delete();

        // Eliminar el usuario asociado
        $personal->user->delete();

        return redirect()->route('Personal.index')->with('success', 'personal eliminado exitosamente.');
    }
}
