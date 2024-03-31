<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PassesTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(StationsTableSeeder::class);
        $this->call(RidesTableSeeder::class);
        $this->call(TicketsTableSeeder::class);
        // $this->call(PassesTableSeeder::class);
        $this->call(ReviewsTableSeeder::class);
        $this->call(CoinRequestsTableSeeder::class);
        $this->call(ChatsTableSeeder::class);
    }
}
