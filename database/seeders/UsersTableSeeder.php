<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Let's clear user tables first
        User::truncate();

        $faker =  \Faker\Factory::create();

        // Let;s make sure everyone has the same password and
        // let's hash it before the loop, or our seeder
        // will be too slow

        // Let's set a default password for all users
        $password = Hash::make('password123'); // Replace 'password123' with your desired default password

        User::create([
            'name' => 'Administrator',
            'email' => 'admin@test.com',
            'password' => $password,
        ]);

        //And now let's generate a few dozen users for our app:
        for ($i=0; $i<10; $i++){
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => $password,
            ]);
        }
    }
}
