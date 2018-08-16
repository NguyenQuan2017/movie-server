<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\FilmInformation;


class FilmInformationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
         foreach(range(1, 10) as $index) {
             FilmInformation::create([
                 'content' => $faker->text,
                 'year' => $faker->year,
                 'high_definition' => 'HD',
                 'episode_number' => '30/30',
                 'view' => $faker->numberBetween(1000,200000),
                 'film_id' => $faker->unique()->numberBetween(1,10)
             ]);
         }
    }
}
