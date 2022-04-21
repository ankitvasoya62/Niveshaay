<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
Use DB;
Use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name'=>'Ankit Vasoya',
            'email'=>'ankit.vasoya@tatvasoft.com',
            'password'=> Hash::make('12345678'),
            'is_admin'=>1
        ]);
    }
}
