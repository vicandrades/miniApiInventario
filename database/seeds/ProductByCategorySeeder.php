<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductByCategory;
use Illuminate\Database\Seeder;

class ProductByCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teCategoryId = Category::where('name', 'bebida')->value('id');
        $productId = Product::where('name', 'bebida')->value('id');
        ProductByCategory::create([
            'product_id' => 1,
            'category_id' => 1,
        ]);
    }
}
