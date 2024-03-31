<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('chats')->insert([
            [
                'user_id' => 1,
                'recipient_id' => 3,
                'message' => 'Hello, how are you?',
            ],
            [
                'user_id' => 3,
                'recipient_id' => 1,
                'message' => 'I am doing well, thank you!',
            ],
        ]);
    }
}