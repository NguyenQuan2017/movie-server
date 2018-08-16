<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Genre;

class CategoryGenreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genre_id = Genre::all()->pluck('id')->toArray();
        $first_genre_id = array_first($genre_id);
        $last_cate_id = array_last($genre_id);

        $genres = Genre::all();

        Category::all()->each(function ($categories) use ($genres, $first_genre_id, $last_cate_id) {
            $categories->genres()->attach(
                $genres->random(rand($first_genre_id, $last_cate_id))->pluck('id')->toArray()
            );
        });
    }
}
