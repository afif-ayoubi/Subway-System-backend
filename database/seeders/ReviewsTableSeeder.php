<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewsTableSeeder extends Seeder
{
    public function run()
    {
        // Seed some example reviews
        DB::table('reviews')->insert([
            [
                'user_id' => 1,
                'ride_id' => 1,
                'rating' => 4,
                'comment' => 'Great ride!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'ride_id' => 2,
                'rating' => 5,
                'comment' => 'Excellent service!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
