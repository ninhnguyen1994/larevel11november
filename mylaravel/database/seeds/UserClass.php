<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserClass extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $faker = Faker\Factory::create();
       DB::table('users')->insert(
           [
            'name' => $faker->name,
            'email' => 'user@admin.com',
            'email_verified_at' => now(),
            'date_of_birth' => '1994-05-10',
            'password' => Hash::make('123456'),
            'gender' => '1',
            'number_phone' => '08078159917',
            'address' => $faker->address,
            'role' => '2',
           ]
       );
    }
}
 