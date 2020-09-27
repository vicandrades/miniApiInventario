<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'té de durazno',
            'price' => 5,
            'stock' => 85,
            'description' => 'té parmalat',
        ]);

        Product::create([
            'name' => 'mermelada',
            'price' => 12,
            'stock' => 100,
            'description' => 'mermelada casera',
        ]);

    }
}
