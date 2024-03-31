<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PassesTableSeeder extends Seeder
{
    public function run()
    {
        // Seed some example passes
        DB::table('passes')->insert([
            [
                'user_id' => 1,
                'type' => 'daily',
                'rides_remaining' => 5,
                'valid_from' => now(),
                'valid_until' => now()->addDay(),
                'purchased_at' => now(),
            ],
            [
                'user_id' => 1,
                'type' => 'monthly',
                'rides_remaining' => 20,
                'valid_from' => now(),
                'valid_until' => now()->addMonth(),
                'purchased_at' => now(),
            ],
        ]);
    }
}
