<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RidesTableSeeder extends Seeder
{
  
    public function run()
    {
        $stationIds = DB::table('stations')->pluck('id');

        foreach ($stationIds as $stationId) {
            $otherStationIds = $stationIds->except($stationId);
            $randomArrivalStationId = $otherStationIds->random();

            for ($i = 0; $i < 5; $i++) {
                $departureTime = now()->addDays($i); 
                $arrivalTime = $departureTime->copy()->addHours(3); 

                DB::table('rides')->insert([
                    'departure_station_id' => $stationId,
                    'arrival_station_id' => $randomArrivalStationId,
                    'departure_time' => $departureTime,
                    'arrival_time' => $arrivalTime,
                    'status' => 'pending',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
