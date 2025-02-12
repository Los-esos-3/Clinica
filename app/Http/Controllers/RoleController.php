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
            'permissions' => 'array',
            'empresa_id' => 'required|exists:empresas,id'
        ]);

        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Rol creado exitosamente.');
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'array',
            'empresa_id' => 'required|exists:empresas,id'
        ]);

        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Rol actualizado exitosamente.');
    }

    public function assignRole(Request $request, User $user)
    {
        $request->validate([
            'roles' => 'required|array',
            'empresa_id' => 'required|exists:empresas,id'
        ]);

        $user->syncRoles($request->roles);
        $user->update(['empresa_id' => $request->empresa_id]);

        return redirect()->route('roles.index')->with('success', 'Roles y empresa asignados exitosamente.');
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
}
