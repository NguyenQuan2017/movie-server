<?php

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = [
            ['genre_name' => 'phim hành động', 'slug' => 'phim-hanh-dong'],
            ['genre_name' => 'phim kinh dị', 'slug' => 'phim-kinh-di'],
            ['genre_name' => 'phim thần thoại', 'slug' => 'phim-than-thoai'],
        ];

        foreach($genres as $genre) {
            Genre::create($genre);
        }
    }
}
