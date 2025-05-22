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
        $rolRoot = Role::create(['name'=>'Root']);
        $rolRoot->givePermissionTo(['ver roles','crear roles', 'editar roles', 'eliminar roles']);
   
       
        $rolAdmin = Role::create(['name' => 'Admin']);
        $rolAdmin->givePermissionTo(
            ['ver dashboard', 'ver pacientes', 'crear pacientes', 'editar pacientes', 'eliminar pacientes', 'ver expedientes',
             'crear expedientes', 'editar expedientes', 'eliminar expedientes', 'ver ingresos', 'crear ingresos', 'ver doctores', 'crear doctores',
              'editar doctores', 'eliminar doctores', 'ver secretarias', 'crear secretarias', 'editar secretarias', 'eliminar secretarias'
            ,'ver empresas', 'crear empresas', 'editar empresas', 'eliminar empresas']);


        $rolDoctor = Role::create(['name' => 'Doctor']);
        $rolDoctor->givePermissionTo(
            ['ver dashboard', 'ver pacientes', 'crear pacientes', 'editar pacientes', 'eliminar pacientes', 'ver expedientes', 
            'crear expedientes', 'editar expedientes', 'eliminar expedientes', 'ver ingresos', 'crear ingresos']);

        
            $rolSecretaria = Role::create(['name' => 'Secretaria']);
        $rolSecretaria->givePermissionTo(
            ['ver dashboard','ver pacientes', 'crear pacientes', 'editar pacientes', 'eliminar pacientes', 'ver expedientes',
            'crear expedientes','editar expedientes','eliminar expedientes']);

        
            $rolUsuario = Role::create(['name'=> 'Usuario']);
    }
}
