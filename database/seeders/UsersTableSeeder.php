<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        // Seed an admin
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role_id' => 3, 
            'location' => 'Headquarters', 
            'coins' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        for ($i = 1; $i <= 5; $i++) {
            DB::table('users')->insert([
                'name' => 'Manager ' . $i,
                'email' => 'manager' . $i . '@example.com',
                'password' => Hash::make('password'),
                'role_id' => 2, 
                'location' => 'Station ' . $i, 
                'coins' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        for ($i = 1; $i <= 10; $i++) {
            DB::table('users')->insert([
                'name' => 'Passenger ' . $i,
                'email' => 'passenger' . $i . '@example.com',
                'password' => Hash::make('password'),
                'role_id' => 1, 
                'location' => 'Random Location',
                'coins' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

