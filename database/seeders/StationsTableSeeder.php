<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StationsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('stations')->insert([
            [
                'name' => 'Station A',
                'manager_id' => 3,
                'latitude' => '40.7128',
                'longitude' => '-74.0060',
                'address' => '123 Station St, City',
                'operating_hours' => '9:00 AM - 5:00 PM',
                'facilities' => 'Wi-Fi, Restrooms',
                'service_status' => 'operational',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Station B',
                'manager_id' => 4,
                'latitude' => '41.8781',
                'longitude' => '-87.6298',
                'address' => '456 Station St, City',
                'operating_hours' => '8:00 AM - 6:00 PM',
                'facilities' => 'Restrooms',
                'service_status' => 'operational',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
