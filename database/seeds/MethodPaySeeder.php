<?php

use App\Models\MethodPay;
use Illuminate\Database\Seeder;

class MethodPaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MethodPay::create([
            'type' => 'pago contra entrega',
        ]);

        MethodPay::create([
            'type' => 'transferencia ach',
            'description' => 'ALLBANK',
        ]);
    }
}
