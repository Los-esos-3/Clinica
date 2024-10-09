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
       // Roles a crear
       $roles = ['Admin', 'Doctor', 'Secretaria'];

     foreach ($roles as $roleName) {
        // Verifica si el rol ya existe antes de crearlo
        if (!Role::where('name', $roleName)->exists()) {
            Role::create(['name' => $roleName]);
        }
    }

     $user = user::find(1);
     $user->assignRole($roles);
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
