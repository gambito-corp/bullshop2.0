<?php

namespace Database\Seeders;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add specific data
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Admin',
                'phone' => '7226049739',
                'email' => 'asesor.pedro@gmail.com',
                'profile' => 'Admin',
                'status' => true,
                'password' => '$2y$10$xUEyj2OPk/MgvOggLzZLrO45X.iDcbm1naWYqE9eKsKoDp35X4MKu',
                'created_at' => '2022-10-06 23:35:45',
                'updated_at' => '2022-10-06 23:35:45'
            ],
            [
                'id' => 2,
                'name' => 'BULLSHOP',
                'phone' => '7226049739',
                'email' => 'bullshop.oficial@gmail.com',
                'profile' => 'Admin',
                'status' => true,
                'password' => '$2y$10$g1RakDQWX9p1gmL1Fgo9ReWW1Lg4zKgZTtbxTWoLlQqJIWgs4a4Gy',
                'created_at' => '2022-10-07 18:53:38',
                'updated_at' => '2022-10-17 05:29:43'
            ],
            [
                'id' => 3,
                'name' => 'Jese velásquez',
                'phone' => '7226049739',
                'email' => 'jese.6.1999@gmail.com',
                'profile' => 'Empleado',
                'status' => true,
                'password' => '$2y$10$nEFcnBAuO4dFT325TJ0Fy.QwIpT1XV.n539ZLhDXGNfJXCvZZucAq',
                'created_at' => '2022-10-07 19:11:48',
                'updated_at' => '2022-10-07 19:11:48'
            ]
        ]);

        // Generate 50 random users
        User::factory()
            ->times(50)
            ->create();
    }
}

