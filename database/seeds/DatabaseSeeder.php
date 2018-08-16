<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(GenreTableSeeder::class);
        $this->call(FilmTableSeeder::class);
        $this->call(FilmInformationTableSeeder::class);
        $this->call(ImageTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);
        $this->call(CategoryGenreTableSeeder::class);
        $this->call(CategoryFilmTableSeeder::class);
        $this->call(FilmGenreTableSeeder::class);

    }
}
