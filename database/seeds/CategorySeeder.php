<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'bebida',
        ]);

        Category::create([
            'name' => 'condimentos',
        ]);

        Category::create([
            'name' => 'frutas',
        ]);

        Category::create([
            'name' => 'lacteos',
        ]);

    }
}
