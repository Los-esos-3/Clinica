<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear permisos
        Permission::create(['name' => 'ver pacientes']);
        Permission::create(['name' => 'crear pacientes']);
        Permission::create(['name' => 'editar pacientes']);
        Permission::create(['name' => 'eliminar pacientes']);

        // Crear roles y asignar permisos
        $rolDoctor = Role::create(['name' => 'doctor']);
        $rolDoctor->givePermissionTo(['ver pacientes', 'crear pacientes', 'editar pacientes', 'eliminar pacientes']);

        $rolAdmin = Role::create(['name' => 'admin']);
        $rolAdmin->givePermissionTo(Permission::all());
    }
}
