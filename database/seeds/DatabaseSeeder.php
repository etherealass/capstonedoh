<?php

use Illuminate\Database\Seeder;
use App\Users;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

        public function run()
    {
        $user = new Users([
            'user_id'=> '123453',
            'fname' => 'Erol',
            'lname' => 'Branzuela',
            'username' => 'Superadmin',
            'password' => Hash::make('erol'),
            'contact' => '09561137482',
            'email' => 'erolbranzuela@ymail.com',
            'role' => '1',
            'department' => '1',
            'designation' => 'IT Support',
            'email_verified_at' => '2019-03-01 00:00:00',
            'remember_token' => 'Null',


        ]);

        $user->save();
    }
}
