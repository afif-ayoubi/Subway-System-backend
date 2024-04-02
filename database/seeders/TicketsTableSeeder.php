<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketsTableSeeder extends Seeder
{
   
    public function run()
    {
        $passengerIds = DB::table('users')->where('role_id', 1)->pluck('id');
        $rideIds = DB::table('rides')->pluck('id');

        foreach ($passengerIds as $passengerId) {
            $randomRideId = $rideIds->random();
            DB::table('tickets')->insert([
                'user_id' => $passengerId,
                'ride_id' => $randomRideId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
