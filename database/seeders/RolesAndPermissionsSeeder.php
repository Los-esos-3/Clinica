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
        Permission::create(['name' => 'ver expedientes']);
        Permission::create(['name' => 'crear expedientes']);
        Permission::create(['name' => 'editar expedientes']);
        Permission::create(['name' => 'eliminar expedientes']);
        Permission::create(['name' => 'ver ingresos']);
        Permission::create(['name' => 'crear ingresos']);
        Permission::create(['name' => 'editar ingresos']);
        Permission::create(['name' => 'eliminar ingresos']);

        // Crear roles y asignar permisos
        $rolDoctor = Role::create(['name' => 'doctor']);
        $rolDoctor->givePermissionTo(['ver pacientes', 'crear pacientes', 'editar pacientes', 'eliminar pacientes', 'ver expedientes']);

        $rolSecretaria = Role::create(['name' => 'secretaria']);
        $rolSecretaria->givePermissionTo(['ver pacientes', 'crear pacientes', 'editar pacientes', 'ver expedientes', 'ver ingresos']);

        $rolAdmin = Role::create(['name' => 'admin']);
        $rolAdmin->givePermissionTo(Permission::all());
    }
}
