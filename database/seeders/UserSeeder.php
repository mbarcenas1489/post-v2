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

        Permission::create(['name' => 'category.index']);
        Permission::create(['name' => 'category.create']);
        Permission::create(['name' => 'category.delete']);
        Permission::create(['name' => 'category.edit']);

        Permission::create(['name' => 'customer.index']);
        Permission::create(['name' => 'customer.create']);
        Permission::create(['name' => 'customer.delete']);
        Permission::create(['name' => 'customer.edit']);

        Permission::create(['name' => 'payment.index']);
        Permission::create(['name' => 'payment.create']);
        Permission::create(['name' => 'payment.delete']);
        Permission::create(['name' => 'payment.edit']);

        Permission::create(['name' => 'supplier.index']);
        Permission::create(['name' => 'supplier.create']);
        Permission::create(['name' => 'supplier.delete']);
        Permission::create(['name' => 'supplier.edit']);

        Permission::create(['name' => 'sales.index']);
        Permission::create(['name' => 'sales.create']);
        Permission::create(['name' => 'sales.delete']);
        Permission::create(['name' => 'sales.edit']);


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
            'email' => 'operador@operador.com',
            'password' => 'operador',
            'email_verified_at' => now(),
        ]);
        $roleOperador = Role::create(['name' => 'operador']);
        $operadorUser->assignRole('operador');

        $permissionsAdmin = Permission::query()->pluck('name');
        $roleAdmin->syncPermissions($permissionsAdmin);
        $roleOperador->syncPermissions([
            'product.index',
            'product.create',
            'category.index',
            'category.create',
            'customer.index',
            'customer.create',
            'payment.index',
            'payment.create',
            'supplier.index',
            'supplier.create',
            'sales.index',
            'sales.create'
        ]);
    }
}
