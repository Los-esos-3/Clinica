<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Empresa;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Doctores;
use Illuminate\Support\Facades\Auth;
use App\Models\Secretarias;
use Illuminate\Support\Facades\DB;

class RoleController
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('ver roles');
        $roles = Role::all();
          $users = User::with('roles')->paginate(10);
        $permissions = Permission::all();
        $empresas = Empresa::all();

        $userStats = [
            'today' => User::whereDate('created_at', today())->count(),
            'month' => User::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),
            'year'  => User::whereYear('created_at', now()->year)->count(),

            // Opcional: Datos para gráficos o tablas
            'monthly_registrations' => $this->getMonthlyRegistrations(),
            'daily_registrations'  => $this->getDailyRegistrations()
        ];

        return view('roles.index', compact('roles', 'users', 'permissions', 'empresas', 'userStats'));
    }

    protected function getMonthlyRegistrations()
    {
        return User::select(
            DB::raw('COUNT(*) as count'),
            DB::raw('MONTH(created_at) as month')
        )
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    }

    // Método para obtener registros diarios (opcional)
    protected function getDailyRegistrations()
    {
        return User::select(
            DB::raw('COUNT(*) as count'),
            DB::raw('DATE(created_at) as date')
        )
            ->whereMonth('created_at', now()->month)
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }   

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        $role = Role::create(['name' => $request->name]);
        $permissions = Permission::whereIn('name', $request->permissions)->pluck('id')->toArray();
        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')->with('success', 'Rol creado exitosamente.');
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'nullable|array',
        ]);

        $permissions = $request->permissions ?? [];

        $role->syncPermissions($permissions);

        $role->update(['name' => $request->name]);

        return redirect()->route('roles.index')->with('success', 'Rol actualizado exitosamente.');
    }

    public function assignRole(Request $request, User $user)
    {
        $roles = Role::all();
        $empresas = Empresa::all();
        return view('roles.assign', compact('roles', 'empresas', 'user'));
    }

    public function storeAssignedRole(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $role = Role::findById($request->role_id); // Busca el rol con Spatie

        if (!$role) {
            return redirect()->back()->with('error', 'Rol no encontrado.');
        }

        // Asignar el nuevo rol, eliminando los anteriores
        $user->syncRoles([$role->name]);

        // Si el rol asignado es "Doctor", crear el registro en la tabla doctores
        if ($role->name === 'Doctor') {
            $this->asignarRolDoctor($userId);
        }

        if ($role->name == 'Secretaria') {
            $this->asignarRolSecretaria($userId);
        }

        return redirect()->route('roles.index')->with('success', 'Rol asignado correctamente.');
    }

    protected function asignarRolDoctor($userId)
    {
        // Obtener el usuario
        $user = User::findOrFail($userId);

        // Obtener el empresa_id del usuario autenticado (admin que asigna el rol)
        $empresaId = Auth::user()->empresa_id;

        // Verificar si ya existe un registro en la tabla doctores para este usuario
        $doctorExistente = Doctores::where('user_id', $user->id)->first();

        if (!$doctorExistente) {
            // Crear un registro en la tabla doctores
            Doctores::create([
                'user_id' => $user->id,
                'nombre_completo' => $user->name,
                'email' => $user->email,
                'empresa_id' => $empresaId, // Asignar el empresa_id del admin
            ]);
        }
    }
    protected function asignarRolSecretaria($userId)
    {
        // Obtener el usuario
        $user = User::findOrFail($userId);

        // Obtener el empresa_id del usuario autenticado (admin que asigna el rol)
        $empresaId = Auth::user()->empresa_id;

        // Verificar si ya existe un registro en la tabla doctores para este usuario
        $secretariaExistente = Secretarias::where('user_id', $user->id)->first();

        if (!$secretariaExistente) {
            // Crear un registro en la tabla doctores
            Secretarias::create(attributes: [
                'user_id' => $user->id,
                'nombre_completo' => $user->name,
                'email' => $user->email,
                'empresa_id' => $empresaId,
            ]);
        }
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $empresas = Empresa::all();
        return view('roles.edit', compact('permissions', 'empresas', 'role'));
    }

    public function create()
    {
        $permissions = Permission::all();
        $empresas = Empresa::all();
        return view('roles.create', compact('permissions', 'empresas'));
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Rol eliminado exitosamente.');
    }

    public function show(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.show', compact('role', 'permissions'));
    }
}
