<?php

use Illuminate\Database\Seeder;
use App\Models\Film;
use App\Models\Category;

class CategoryFilmTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $film_id = Film::all()->pluck('id')->toArray();
        $first_film_id = array_first($film_id);
        $last_film_id = array_last($film_id);

        $films = Film::all();
        Category::all()->each(function ($categories) use ($films, $first_film_id, $last_film_id) {
            $categories->films()->attach(
                $films->random(rand($first_film_id, $last_film_id))->pluck('id')->toArray()
            );
        });
    }
}
