<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatsTableSeeder extends Seeder
{
   
    public function run()
    {
        $passengerIds = DB::table('users')->where('role_id', 1)->pluck('id');

        $managerIds = DB::table('users')->where('role_id', 2)->pluck('id');

        foreach ($passengerIds as $passengerId) {
            foreach ($managerIds as $managerId) {
                for ($i = 0; $i < 3; $i++) {
                    DB::table('chats')->insert([
                        'user_id' => $passengerId,
                        'recipient_id' => $managerId,
                        'message' => 'Message from passenger ' . $passengerId . ' to manager ' . $managerId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
