<?php

use Illuminate\Database\Seeder;
use App\Users;
use App\Departments;
use App\User_roles;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_roles')->insert(
        [

            'parent' => '0',
            'name' =>'Superadmin',
            'description' => 'Superadmin',
        ]);
         DB::table('user_roles')->insert([
            'parent' => '0',
            'name' =>'Admin',
            'description' => 'Admin',
        ]);
         DB::table('user_roles')->insert([
            'parent' => '0',
            'name' =>'Doctor',
            'description' => 'Doctor',
        ]);
         DB::table('user_roles')->insert([
            'parent' => '0',
            'name' =>'Nurse',
            'description' => 'Nurse',
        ]);
         DB::table('user_roles')->insert([
            'parent' => '0',
            'name' =>'Social Worker',
            'description' => 'Social Worker',
        ]);
         DB::table('user_roles')->insert([
            'parent' => '0',
            'name' =>'Physciatrist',
            'description' => 'Physciatrist',
        ]);
         DB::table('user_roles')->insert([
            'parent' => '0',
            'name' =>'Dentist',
            'description' => 'Dentist',
        ]);

         DB::table('departments')->insert([

                'department_name' => 'Inpatient',
                'description' => 'Inpatient'
         ]);

          DB::table('departments')->insert([

                'department_name' => 'Outpatient',
                'description' => 'Outpatient'
         ]);

        DB::table('departments')->insert([

                'department_name' => 'Aftercare',
                'description' => 'Aftercare'
         ]);

        DB::table('departments')->insert([

                'department_name' => 'Aftercare',
                'description' => 'Aftercare'
         ]);



         DB::table('case__types')->insert([
                'case_id' => rand(),
                'case_name' => 'Voluntary Submission',
                'court_order' => 0

         ]);
         DB::table('case__types')->insert([
                'case_id' => rand(),
                'case_name' => 'Voluntary with Court Order',
                'court_order' => 1
                
         ]);
         DB::table('case__types')->insert([
                'case_id' => rand(),
                'case_name' => 'Plea Bargain',
                'court_order' => 1
                
         ]);


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
