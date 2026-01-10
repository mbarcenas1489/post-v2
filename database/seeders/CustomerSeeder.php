<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            ['name' => 'Consumidor Final', 'email' => null],
            ['name' => 'Empresa ABC', 'email' => 'ventas@empresa-abc.com'],
        ];
        foreach ($customers as $data) {
            Customer::firstOrCreate(['name' => $data['name']], $data);
        }
    }
}
