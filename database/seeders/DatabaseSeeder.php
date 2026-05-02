<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            SupplierSeeder::class,
            CustomerSeeder::class,
            ProductSeeder::class,
            UserSeeder::class,
        ]);

        // Usuario admin de prueba si no existe
        \App\Models\User::firstOrCreate(
            ['email' => 'admin@pos.test'],
            [
                'name' => 'Admin POS',
                'password' => bcrypt('admin1234'),
            ]
        );
    }
}
