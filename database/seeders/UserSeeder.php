<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name'=> 'RootPredefinido',
            'email'=>'Root1@gmail.com',
            'phone'=> '0000000000',
            'trial_used'=> false,
            'password'=> 'RootExpedined12',
        ]);


        $user->assignRole('Root');
    }
}
