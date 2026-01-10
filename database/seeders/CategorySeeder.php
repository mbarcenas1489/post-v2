<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Bebidas', 'slug' => 'bebidas'],
            ['name' => 'Snacks', 'slug' => 'snacks'],
            ['name' => 'Limpieza', 'slug' => 'limpieza'],
        ];
        foreach ($categories as $data) {
            Category::firstOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
