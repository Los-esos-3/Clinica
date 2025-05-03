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
      return view("Trabajadores.index", compact('trabajadores'));
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
        Log::info('Entró al método');
        Log::info($request->all());

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
        Log::info('Todos los datos validados');
        Log::info($validated);

        // Crear el usuario
        $user = User::create([
            'name' => $validated['name'], // Usar 'name' en lugar de 'nombre'
            'email' => $validated['email'], // Usar 'email' en lugar de 'correo'
            'password' => Hash::make($validated['password']),
            'empresa_id' => Auth::user()->empresa_id, // Asignar la misma empresa que el admin
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
            'nombre' => $validated['name'], // Usar 'name' en lugar de 'nombre'
            'foto_perfil' => $fotoPerfilPath,
            'user_id' => $user->id,
            'correo' => $validated['email'], // Usar 'email' en lugar de 'correo'
            'password' => Hash::make($validated['password']),
            'tel' => $validated['tel'] ?? null, // Teléfono opcional
            'rol' => $validated['rol'],
            'empresa_id' => Auth::user()->empresa_id, // Asignar la misma empresa que el admin
        ]);

        // Crear registro en la tabla correspondiente (doctor o secretaria)
        if ($validated['rol'] === 'Doctor') {
            Doctores::create([
                'trabajador_id' => $trabajador->id, // Pasar el ID del trabajador
                'especialidad' => 'General', // Puedes personalizar esto
                'user_id' => $user->id, // Pasar el user_id del trabajador
                'email'=> $validated['email'],
                'nombre_completo' => $validated['name'],
                'empresa_id' => Auth::user()->empresa_id, // Asignar la misma empresa que el admin
            ]);
        } elseif ($validated['rol'] === 'Secretaria') {
            Secretarias::create([
                'trabajador_id' => $trabajador->id,
                'user_id' => $user->id, // Pasar el user_id del trabajador
                'nombre_completo' => $validated['name'],
                'email'=> $validated['email'],
                'empresa_id' => Auth::user()->empresa_id, // Asignar la misma empresa que el admin
            ]);
        }

        return redirect()->route('Trabajadores.index')->with('success', 'Trabajador creado exitosamente.');
    }

    public function edit(Trabajadores $trabajador)
    {
        // Obtener los roles permitidos
        $allowedRoles = ['Doctor', 'Secretaria', 'Admin'];
        $roles = Role::whereIn('name', $allowedRoles)->get();

        return view('Trabajadores.edit', compact('trabajador', 'roles'));
    }

    public function update(Request $request, Trabajadores $trabajador)
    {
        Log::info('Entró al método update');
        Log::info($request->all());

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validar como imagen
                'email' => 'required|string|email|max:255|unique:users,email,' . $trabajador->user_id, // Validar correo único
                'tel' => 'nullable|string|max:15', // Validar teléfono
                'password' => 'nullable|string|min:8|confirmed', // Contraseña opcional
                'rol' => 'required|exists:roles,name',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Error de validación: ' . $e->getMessage());
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        // Actualizar el usuario asociado
        $user = $trabajador->user;
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'] ? Hash::make($validated['password']) : $user->password,
        ]);

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

        // Actualizar el registro en la tabla correspondiente (doctor o secretaria)
        if ($validated['rol'] === 'Doctor') {
            Doctores::where('trabajador_id', $trabajador->id)->update([
                'nombre_completo' => $validated['name'],
                'email' => $validated['email'],
            ]);
        } elseif ($validated['rol'] === 'Secretaria') {
            Secretarias::where('trabajador_id', $trabajador->id)->update([
                'nombre_completo' => $validated['name'],
                'email' => $validated['email'],
            ]);
        }

        return redirect()->route('Trabajadores.index')->with('success', 'Trabajador actualizado exitosamente.');
    }

    public function destroy(Trabajadores $trabajador)
    {
        // Eliminar registros relacionados en las tablas doctores o secretarias
        if ($trabajador->rol === 'Doctor') {
            Doctores::where('trabajador_id', $trabajador->id)->delete();
        } elseif ($trabajador->rol === 'Secretaria') {
            Secretarias::where('trabajador_id', $trabajador->id)->delete();
        }

        // Eliminar el usuario asociado
        $trabajador->user->delete();

        // Eliminar el trabajador
        $trabajador->delete();

        return redirect()->route('Trabajadores.index')->with('success', 'Trabajador eliminado exitosamente.');
    }
}