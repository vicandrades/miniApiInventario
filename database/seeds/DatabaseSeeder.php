<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables([
            'users',
            'category',
            'product',
            'product_by_category',
            'method_pay',
            'purchase',
            'configuration',
            'product_by_purchase',
        ]);

        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductByCategorySeeder::class);
        $this->call(MethodPaySeeder::class);
        $this->call(ConfigurationSeeder::class);
    }

    protected function truncateTables(array $tables)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
