<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use App\Models\Stock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = Category::create(['name' => 'Electronics']);
        $size = Size::create(['name' => 'M']);
        $brand = Brand::create(['name' => 'Apex']);

        $product1 = Product::create([
            'name' => 'Product 1',
            'category_id' => $category->id,
            'size_id' => $size->id,
            'brand_id' => $brand->id,
            'description' => 'Product 1 description',
            'price' => 49.99,
            'quantity_in_stock' => 100,
        ]);

        $product2 = Product::create([
            'name' => 'Product 2',
            'category_id' => $category->id,
            'size_id' => $size->id,
            'brand_id' => $brand->id,
            'description' => 'Product 2 description',
            'price' => 39.99,
            'quantity_in_stock' => 75,
        ]);

        $stock1 = Stock::create([
            'product_id' => $product1->id,
            'size_id' => $product1->size_id,
            'quantity' => 50,
            'location' => 'Y'
        ]);

        $stock2 = Stock::create([
            'product_id' => $product2->id,
            'size_id' => $product2->size_id,
            'quantity' => 25,
            'location' => 'Y'
        ]);
    }
}
