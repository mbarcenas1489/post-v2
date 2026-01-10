<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = Category::firstOrCreate(['slug' => 'bebidas'], ['name' => 'Bebidas']);
        $supplier = Supplier::firstOrCreate(['name' => 'Proveedor Central']);

        $products = [
            [
                'name' => 'Agua Mineral 500ml',
                'sku' => 'AG-500',
                'sale_price' => 0.80,
                'cost_price' => 0.40,
                'stock' => 100,
                'min_stock' => 10,
            ],
            [
                'name' => 'Gaseosa Cola 1L',
                'sku' => 'COLA-1L',
                'sale_price' => 1.20,
                'cost_price' => 0.70,
                'stock' => 60,
                'min_stock' => 8,
            ],
        ];

        foreach ($products as $data) {
            Product::firstOrCreate(
                ['sku' => $data['sku']],
                array_merge($data, [
                    'category_id' => $category->id,
                    'supplier_id' => $supplier->id,
                    'status' => 'active',
                ])
            );
        }
    }
}
