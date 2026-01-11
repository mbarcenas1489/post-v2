<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'users.index']);
        Permission::create(['name' => 'users.create']);
        Permission::create(['name' => 'users.delete']);
        Permission::create(['name' => 'users.edit']);

        Permission::create(['name' => 'product.index']);
        Permission::create(['name' => 'product.create']);
        Permission::create(['name' => 'product.delete']);
        Permission::create(['name' => 'product.edit']);

        $adminUser = User::query()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => 'admin',
            'email_verified_at' => now(),
        ]);
        $roleAdmin = Role::create(['name' => 'admin']);
        $adminUser->assignRole('admin');

        $permissionsAdmin = Permission::query()->pluck('name');
        $roleAdmin->syncPermissions($permissionsAdmin);


        $operadorUser = User::query()->create([
            'name' => 'operador',
            'email' => 'operador@admin.com',
            'password' => 'operador',
            'email_verified_at' => now(),
        ]);
        $roleOperador = Role::create(['name' => 'operador']);
        $operadorUser->assignRole('operador');

        $permissionsAdmin = Permission::query()->pluck('name');
        $roleAdmin->syncPermissions($permissionsAdmin);
        $roleOperador->syncPermissions(['product.index', 'product.create']);
    }
}
