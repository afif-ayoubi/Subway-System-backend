<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoinRequestsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('coin_requests')->insert([
            [
                'user_id' => 1,
                'amount' => 100,
                'status' => 'pending',
                'requested_at' => now(),
            ],
            [
                'user_id' => 2,
                'amount' => 200,
                'status' => 'pending',
                'requested_at' => now(),
            ],
        ]);
    }
}