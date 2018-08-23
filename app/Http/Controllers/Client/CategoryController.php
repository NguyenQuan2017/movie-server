<?php

namespace App\Http\Controllers\Client;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function getCategories() {
        $categories = Category::all();

        return response_success([
            'categories' => $categories
        ],'get data success');
    }
}
