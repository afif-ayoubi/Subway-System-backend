<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoinRequestsTableSeeder extends Seeder
{

    public function run()
    {
        $passengerIds = DB::table('users')->where('role_id', 1)->pluck('id');


        foreach ($passengerIds as $passengerId) {
            DB::table('coin_requests')->insert([
                'user_id' => $passengerId,
                'amount' => rand(10, 100), 
                'status' => 'pending',
                'requested_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}