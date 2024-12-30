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
        // Kategorileri ekle
        $this->call(CategorySeeder::class);

        // Kullanıcı ekle
        User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'username' => 'johndoe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'), // veya Hash::make
        ]);

        // Ürünleri ekle
        $this->call(ProductSeeder::class);
    }
}
