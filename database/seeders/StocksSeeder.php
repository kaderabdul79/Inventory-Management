<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Size;
use App\Models\Stock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StocksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $productId = 1;

        // Stock::create([
        //     'product_id' => $productId,
        //     'quantity' => 50,
        // ]);
        $products = Product::all();
        $sizes = Size::all();

        // Loop to insert data
        foreach ($products as $product) {
            foreach ($sizes as $size) {
                Stock::create([
                    'product_id' => $product->id,
                    'size_id' => $size->id,
                    'quantity' => 5, //default quantity I set it to 5
                ]);
            }
        }
    }
}
