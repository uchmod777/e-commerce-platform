<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $electronics = Category::where('slug', 'electronics')->first();
        $clothing = Category::where('slug', 'clothing')->first();
        $books = Category::where('slug', 'books')->first();

        $products = [
            [
                'category_id' => $electronics->id,
                'name' => 'Wireless Headphones',
                'description' => 'Premium noise-cancelling wireless headphones',
                'price' => 199.99,
                'stock_quantity' => 50,
                'sku' => 'WH-001',
            ],
            [
                'category_id' => $electronics->id,
                'name' => 'Smart Watch',
                'description' => 'Fitness tracking smart watch with heart rate monitor',
                'price' => 299.99,
                'stock_quantity' => 30,
                'sku' => 'SW-001',
            ],
            [
                'category_id' => $clothing->id,
                'name' => 'Cotton T-Shirt',
                'description' => '100% organic cotton t-shirt',
                'price' => 29.99,
                'stock_quantity' => 100,
                'sku' => 'TS-001',
            ],
            [
                'category_id' => $clothing->id,
                'name' => 'Denim Jeans',
                'description' => 'Classic fit denim jeans',
                'price' => 79.99,
                'stock_quantity' => 75,
                'sku' => 'DJ-001',
            ],
            [
                'category_id' => $books->id,
                'name' => 'Laravel: Up & Running',
                'description' => 'A comprehensive guide to Laravel framework',
                'price' => 49.99,
                'stock_quantity' => 25,
                'sku' => 'BK-001',
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate([
                ...$product,
                'slug' => Str::slug($product['name']),
                'is_active' => true,
            ]);
        }
    }
}
