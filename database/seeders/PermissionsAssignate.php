<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsAssignate extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
 
   
        $rolAdmin = Role::create(['name' => 'Admin']);
        $rolAdmin->givePermissionTo(Permission::all());

        $rolDoctor = Role::create(['name' => 'Doctor']);
        $rolDoctor->givePermissionTo(['ver dashboard', 'ver pacientes', 'crear pacientes', 'editar pacientes', 'eliminar pacientes', 'ver expedientes', 'crear expedientes', 'editar expedientes', 'eliminar expedientes', 'ver ingresos', 'crear ingresos']);

        $rolSecretaria = Role::create(['name' => 'Secretaria']);
        $rolSecretaria->givePermissionTo(['ver dashboard','ver pacientes', 'crear pacientes', 'editar pacientes', 'eliminar pacientes', 'ver expedientes','crear expedientes','editar expedientes','eliminar expedientes', 'ver ingresos', 'crear ingresos']);

        $rolUsuario = Role::create(['name'=> 'Usuario']);
    }
}
