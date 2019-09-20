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
            'user_id' => rand(),
    		'fname' => 'Erol',
    		'lname' => 'Branzuela',
    		'username' => 'Superadmin',
    		'password' => Hash::make('erol'),
    		'contact' => '09561137482',
    		'email' => 'erolbranzuela@ymail.com',
    		'role' => '1',
    	]);

    	$user->save();
    }
}
