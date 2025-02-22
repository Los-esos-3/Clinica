<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Empresa;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;

class RoleController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('ver roles');
        $roles = Role::all();
        $users = User::all();
        $permissions = Permission::all();
        $empresas = Empresa::all();
        return view('roles.index', compact('roles', 'users', 'permissions', 'empresas'));
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

    $user->syncRoles([$role->name]); // Asigna el nuevo rol, eliminando los anteriores
    // Si deseas que pueda tener múltiples roles, usa `$user->assignRole($role->name);`

    return redirect()->route('roles.index')->with('success', 'Rol asignado correctamente.');
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
