<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketsTableSeeder extends Seeder
{
    public function run()
    {
        // Seed some example tickets
        DB::table('tickets')->insert([
            [
                'user_id' => 1,
                'ride_id' => 1,
            ],
            [
                'user_id' => 2,
                'ride_id' => 2,
            ],
        ]);
    }
}
