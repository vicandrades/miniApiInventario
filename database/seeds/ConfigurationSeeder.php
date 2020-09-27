<?php

use App\Models\Configuration;
use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Configuration::create([
            'min_stock' => 20,
            'iva' => 5,
            'min_price' => 5,
        ]);
    }
}
