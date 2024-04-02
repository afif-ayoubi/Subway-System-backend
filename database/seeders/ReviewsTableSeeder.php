<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewsTableSeeder extends Seeder
{

    public function run()
    {
        $passengerIds = DB::table('users')->where('role_id', 1)->pluck('id');

        $stationIds = DB::table('stations')->pluck('id');

        foreach ($passengerIds as $passengerId) {
            foreach ($stationIds as $stationId) {
                $rating = rand(1, 5);

                DB::table('reviews')->insert([
                    'user_id' => $passengerId,
                    'station_id' => $stationId,
                    'rating' => $rating,
                    'comment' => 'This station is great!', 
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
