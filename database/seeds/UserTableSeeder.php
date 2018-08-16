<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name' => 'quan',
            'last_name' => 'van',
            'user_name' => 'quan1996',
            'email' => 'quan@autointegrity.com.au',
            'avatar' => 'http://movieserver.localhost:8081/uploads/avatar/quan.jpg',
            'user_status' => 1,
            'password' => bcrypt('123456')
        ]);

        $faker = Faker::create();

        foreach(range(1,10) as $index) {
           User::create([
               'first_name' => $faker->firstName,
               'last_name' => $faker->lastName,
               'user_name' => $faker->name,
               'email' => $faker->email,
               'avatar' => $faker->imageUrl($width = 640, $height = 480),
               'user_status' => 1,
               'password' => bcrypt('123456')
           ]);
        }
    }
}
