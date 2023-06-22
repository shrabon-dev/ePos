<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleManagementSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'store manager']);
        Role::create(['name' => 'inventory manager']);
        Role::create(['name' => 'administrator']);
        Role::create(['name' => 'accountant']);

        Permission::create(['name' => 'add']);
        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'view']);
        Permission::create(['name' => 'delete']);
        Permission::create(['name' => 'sales']);
        Permission::create(['name' => 'purchase']);

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
        $user= User::find(1);
        $user->assignRole($role);

    }
}
