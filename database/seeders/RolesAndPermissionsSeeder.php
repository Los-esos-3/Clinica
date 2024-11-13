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

        //Permisos para el apartado de Pacientes
        Permission::create(['name' => 'ver pacientes']);
        Permission::create(['name' => 'crear pacientes']);
        Permission::create(['name' => 'editar pacientes']);
        Permission::create(['name' => 'eliminar pacientes']);

        //Permisos para el apartado de Expedientes
        Permission::create(['name' => 'ver expedientes']);
        Permission::create(['name' => 'crear expedientes']);
        Permission::create(['name' => 'editar expedientes']);
        Permission::create(['name' => 'eliminar expedientes']);

        //Permisos para el apartado de Ingresos
        Permission::create(['name' => 'ver ingresos']);
        Permission::create(['name' => 'crear ingresos']);
        Permission::create(['name' => 'editar ingresos']);
        Permission::create(['name' => 'eliminar ingresos']);

        //Permisos para el apartado de Doctores
        Permission::create(['name'=>'ver doctores']);
        Permission::create(['name'=>'crear doctores']);
        Permission::create(['name'=>'editar doctores']);
        Permission::create(['name'=>'eliminar doctores']);

        //Permisos par el apartado de Empresas
        Permission::create(['name'=>'ver empresas']);
        Permission::create(['name'=>'crear empresas']);
        Permission::create(['name'=>'editar empresas']);
        Permission::create(['name'=>'eliminar empresas']);


        // Crear roles y asignar permisos 
        $rolAdmin = Role::create(attributes: ['name' => 'Admin']);
        $rolAdmin->givePermissionTo(permissions: Permission::all());

        $rolDoctor = Role::create(attributes: ['name' => 'Doctor']);
        $rolDoctor->givePermissionTo(permissions: ['ver dashboard','ver pacientes', 'ver expedientes', 'ver ingresos']);

        $rolSecretaria = Role::create(attributes: ['name' => 'Secretaria']);
        $rolSecretaria->givePermissionTo(permissions: ['ver dashboard','ver pacientes', 'crear pacientes', 'editar pacientes', 'eliminar pacientes', 'ver expedientes','crear expedientes','editar expedientes','eliminar expedientes', 'ver ingresos', 'crear ingresos']);

        $rolUsuario = Role::create(attributes: ['name'=> 'Usuario']);
       
    }
}
