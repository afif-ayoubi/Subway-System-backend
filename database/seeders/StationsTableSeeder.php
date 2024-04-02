<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StationsTableSeeder extends Seeder
{

    public function run()
    {
        $managerIds = DB::table('users')->where('role_id', 2)->pluck('id');

        foreach ($managerIds as $index => $managerId) {
            $latitude = 51.5074 + ($index * 0.01); 
            $longitude = -0.1278 + ($index * 0.01); 

            DB::table('stations')->insert([
                'name' => 'Station for Manager ' . $managerId,
                'manager_id' => $managerId,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'address' => 'London, UK',
                'operating_hours' => '9:00 AM - 5:00 PM',
                'facilities' => 'Facility 1, Facility 2',
                'service_status' => 'operational',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
