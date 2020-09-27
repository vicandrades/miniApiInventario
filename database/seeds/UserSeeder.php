<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Victor Manuel',
            'email' => 'victormanuel.andrades@gmail.com',
            'password' => bcrypt('test'),
            'balance' => 1000,
            'is_admin' => true,
        ]);
    }
}
