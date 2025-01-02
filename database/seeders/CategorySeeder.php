<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {

        Category::create([
            'name' => 'Clothing',
            'description' => 'Men and women clothing.'
        ]);

        Category::create([
            'name' => 'Perfumes',
            'description' => 'Luxury perfumes.'
        ]);

        Category::create([
            'name' => 'Books',
            'description' => 'Various types of books.'
        ]);

        Category::create([
            'name' => 'Pet Products',
            'description' => 'Products for pets.'
        ]);

        Category::create([
            'name' => 'Electronics',
            'description' => 'Electronic devices and gadgets.'
        ]);
    }
}
