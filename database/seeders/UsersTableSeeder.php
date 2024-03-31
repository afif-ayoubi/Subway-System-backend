<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{

    public function run(): void
    {
         DB::table('users')->insert([
            'name' => 'Passenger User',
            'email' => 'passenger@example.com',
            'password' => Hash::make('password'),
            'role_id' => 1, 
            'location' => 'Some location',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role_id' => 3,
            'location' => 'Admin location',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Manager User',
            'email' => 'manager@example.com',
            'password' => Hash::make('password'),
            'role_id' => 2, 
            'location' => 'Manager location',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Manager2 User',
            'email' => 'manager2@example.com',
            'password' => Hash::make('password'),
            'role_id' => 2, 
            'location' => 'Manager location',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
