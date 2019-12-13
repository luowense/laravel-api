<?php

use Illuminate\Database\Seeder;
use App\Message;
use App\User;

class MessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::find(1);
        $message = new Message();
        $message->body = 'test';
        $message->user= $user;
        $message->save();
    }
}
