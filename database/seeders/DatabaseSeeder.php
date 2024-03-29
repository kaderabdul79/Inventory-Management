<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\BrandsSeeder;
use Database\Seeders\CategoriesSeeder;
use Database\Seeders\SizesSeeder;
use Database\Seeders\StocksSeeder;
use Database\Seeders\UsersSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            CategoriesSeeder::class,
            SizesSeeder::class,
            BrandsSeeder::class,
            ProductsSeeder::class,
            StocksSeeder::class,
            UsersSeeder::class,
        ]);
    }
}
