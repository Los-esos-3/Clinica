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
use App\Models\Trabajadores;

class TrabajadoresController
{
    public function index()
    {
        $trabajadores = Trabajadores::with('user', 'empresa')->paginate(9); // Paginación de 9 elementos por página
     return view('trabajadores.index',compact('trabajadores')); // Nota: minúsculas
    }

    public function create()
    {
        // Filtrar solo los roles permitidos
        $allowedRoles = ['Doctor', 'Secretaria', 'Admin'];
        $roles = Role::whereIn('name', $allowedRoles)->get();
        return view('Trabajadores.create', compact('roles'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validar como imagen
                'email' => 'required|string|email|max:255|unique:users,email', // Validar correo electrónico
                'tel' => 'nullable|string|max:15', // Validar teléfono
                'password' => 'required|string|min:8|confirmed', // Validar contraseña
                'rol' => 'required|exists:roles,name',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Error de validación: ' . $e->getMessage());
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        // Crear el usuario
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'empresa_id' => Auth::user()->empresa_id,
        ]);

        // Asignar el rol al usuario
        $user->assignRole($validated['rol']);

        // Guardar la foto de perfil si existe
        $fotoPerfilPath = null;
        if ($request->hasFile('foto_perfil')) {
            $fotoPerfilPath = $request->file('foto_perfil')->store('fotos_perfil', 'public');
        }

        // Crear el trabajador
        $trabajador = Trabajadores::create([
            'nombre' => $validated['name'],
            'foto_perfil' => $fotoPerfilPath,
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
                'trabajador_id' => $trabajador->id,
                'foto_perfil' => $fotoPerfilPath, // Usa el valor guardado
                'especialidad' => 'General',
                'user_id' => $user->id,
                'email' => $validated['email'],
                'nombre_completo' => $validated['name'],
                'empresa_id' => Auth::user()->empresa_id,
            ]);
        } elseif ($validated['rol'] === 'Secretaria') {
            Secretarias::create([
                'trabajador_id' => $trabajador->id,
                'foto_perfil' => $fotoPerfilPath, // Usa el valor guardado
                'user_id' => $user->id,
                'nombre_completo' => $validated['name'],
                'email' => $validated['email'],
                'empresa_id' => Auth::user()->empresa_id,
            ]);
        }

        return redirect()->route('Trabajadores.index')->with('success', 'Trabajador creado exitosamente.');
    }
    public function edit(Trabajadores $trabajador, $id)
    {
        // Obtener los roles permitidos
        $allowedRoles = ['Doctor', 'Secretaria', 'Admin'];
        $roles = Role::whereIn('name', $allowedRoles)->get();
        $trabajador = Trabajadores::findOrFail($id);

        return view('Trabajadores.edit', compact('trabajador', 'roles'));
    }

    public function update(Request $request, Trabajadores $trabajador, $id)
    {
        $trabajador = Trabajadores::findOrFail($id);

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'email' => 'required|string|email|max:255|unique:users,email,' . $trabajador->user_id,
                'tel' => 'nullable|string|max:15',
                'password' => 'nullable|string|min:8|confirmed',
                'rol' => 'required|exists:roles,name',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Error de validación: ' . $e->getMessage());
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        // Actualizar el usuario asociado
        $user = User::find($trabajador->user_id);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'] ? Hash::make($validated['password']) : $user->password,
        ]);

        // Obtener el rol anterior para comparar
        $oldRole = $user->getRoleNames()->first();

        // Actualizar el rol del usuario
        $user->syncRoles([$validated['rol']]);

        // Guardar la nueva foto de perfil si existe
        if ($request->hasFile('foto_perfil')) {
            $fotoPerfilPath = $request->file('foto_perfil')->store('fotos_perfil', 'public');
            $trabajador->update(['foto_perfil' => $fotoPerfilPath]);
        }

        // Actualizar el trabajador
        $trabajador->update([
            'nombre' => $validated['name'],
            'correo' => $validated['email'],
            'tel' => $validated['tel'] ?? null,
            'rol' => $validated['rol'],
        ]);

        // Manejo de roles específicos (Doctor/Secretaria)
        if ($validated['rol'] !== $oldRole) {
            // Si el rol cambió, eliminar registros antiguos
            if ($oldRole === 'Doctor') {
                Doctores::where('trabajador_id', $trabajador->id)->delete();
            } elseif ($oldRole === 'Secretaria') {
                Secretarias::where('trabajador_id', $trabajador->id)->delete();
            }
        }

        // Crear o actualizar registro según el nuevo rol
        if ($validated['rol'] === 'Doctor') {
            $doctor = Doctores::firstOrNew(['trabajador_id' => $trabajador->id]);
            $doctor->fill([
                'nombre_completo' => $validated['name'],
                'email' => $validated['email'],
                'user_id' => $user->id,
            ])->save();
        } elseif ($validated['rol'] === 'Secretaria') {
            $secretaria = Secretarias::firstOrNew(['trabajador_id' => $trabajador->id]);
            $secretaria->fill([
                'nombre_completo' => $validated['name'],
                'email' => $validated['email'],
                'user_id' => $user->id,
            ])->save();
        } else {
            // Para otros roles (Admin), eliminar registros específicos si existen
            Doctores::where('trabajador_id', $trabajador->id)->delete();
            Secretarias::where('trabajador_id', $trabajador->id)->delete();
        }

        return redirect()->route('Trabajadores.index')->with('success', 'Trabajador actualizado exitosamente.');
    }

    public function destroy(Trabajadores $trabajador, $id)
    {
        $trabajador = Trabajadores::findOrFail($id);

        // Eliminar registros relacionados en las tablas doctores o secretarias
        if ($trabajador->rol === 'Doctor') {
            Doctores::where('trabajador_id', $trabajador->id)->delete();
        } elseif ($trabajador->rol === 'Secretaria') {
            Secretarias::where('trabajador_id', $trabajador->id)->delete();
        }

        // Eliminar el trabajador
        $trabajador->delete();

        // Eliminar el usuario asociado
        $trabajador->user->delete();

        return redirect()->route('Trabajadores.index')->with('success', 'Trabajador eliminado exitosamente.');
    }
}
