<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            // Create 6 products for each category
            for ($i = 1; $i <= 6; $i++) {
                Product::create([
                    'name' => "{$category->name} Product {$i}",
                    'description' => "{$category->name} description for product {$i}.",
                    'price' => rand(10, 100),
                    'stock' => rand(1, 50),
                    'image_url' => 'https://via.placeholder.com/300x200',
                    'category_id' => $category->id,
                ]);
            }
        }
    }
}

