<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Image;

class ImageTableSeeder extends Seeder
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
            Image::create([
                'image_name' => $faker->sentence(3),
                'slug' => $faker->slug,
                'link' => $faker->imageUrl($width = 640, $height = 480),
                'film_id' => $faker->unique()->numberBetween(1, 10)
            ]);
        }
    }
}
