<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['cate_name' => 'phim bộ','slug' => 'phim-bo'],
            ['cate_name' => 'phim lẻ','slug' => 'phim-le'],
            ['cate_name' => 'phim chiếu rạp','slug' => 'phim chieu rap'],
            ['cate_name' => 'anime', 'slug' => 'anime']
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
