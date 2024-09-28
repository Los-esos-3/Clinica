<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
     $role1 = Role::create(['name'=>'Admin']);
     $role2 = Role::create(['name'=>'Doctor']);
     $role3 = Role::create(['name'=>'Secretaria']);

     $user = user::find(1);
     $user->assignRole($role1);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Role::where('name', 'Doctor')->delete();
        Role::where('name', 'Secretaria')->delete();
    }
};
