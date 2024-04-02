<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PassesTableSeeder extends Seeder
{
   
    public function run()
    {
        $passengerIds = DB::table('users')->where('role_id', 1)->pluck('id');

        foreach ($passengerIds as $passengerId) {
            for ($i = 0; $i < 3; $i++) { 
                DB::table('passes')->insert([
                    'user_id' => $passengerId,
                    'type' => 'daily', 
                    'valid_from' => now()->addDays($i),
                    'valid_until' => now()->addDays($i + 1),
                    'purchased_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
