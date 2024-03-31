<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RidesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('rides')->insert([
            [
                'departure_station_id' => 1,
                'arrival_station_id' => 2,
                'departure_time' => now(),
                'arrival_time' => now()->addHours(2),
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'departure_station_id' => 2,
                'arrival_station_id' => 1,
                'departure_time' => now()->addHours(3),
                'arrival_time' => now()->addHours(5),
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
