<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Film;

class FilmTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach(range(1,10) as $index) {
            Film::create([
                'film_name' => $faker->sentence(3),
                'film_name_el' => $faker->sentence(3),
                'slug' => $faker->slug,
                'description' => $faker->paragraph(10)
            ]);
        }
    }
}
