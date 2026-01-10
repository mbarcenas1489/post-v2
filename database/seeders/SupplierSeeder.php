<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            ['name' => 'Proveedor Central', 'email' => 'central@example.com', 'phone' => '555-1000'],
            ['name' => 'Distribuciones XYZ', 'email' => 'xyz@example.com', 'phone' => '555-2000'],
        ];
        foreach ($suppliers as $data) {
            Supplier::firstOrCreate(['name' => $data['name']], $data);
        }
    }
}
