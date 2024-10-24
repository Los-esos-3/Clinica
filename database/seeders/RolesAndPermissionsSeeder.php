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
        Permission::create(['name'=>'ver dashboard']);
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
        $rolAdmin = Role::create(['name' => 'Admin']);
        $rolAdmin->givePermissionTo(Permission::all());

        $rolDoctor = Role::create(['name' => 'Doctor']);
        $rolDoctor->givePermissionTo(['ver dashboard','ver pacientes', 'ver expedientes', 'ver ingresos']);

        $rolSecretaria = Role::create(['name' => 'Secretaria']);
        $rolSecretaria->givePermissionTo(['ver dashboard','ver pacientes', 'crear pacientes', 'editar pacientes', 'eliminar pacientes', 'ver expedientes','crear expedientes','editar expedientes','eliminar expedientes', 'ver ingresos', 'crear ingresos']);

        $rolUsuario = Role::create(['name'=> 'Usuario']);
       
    }
}
