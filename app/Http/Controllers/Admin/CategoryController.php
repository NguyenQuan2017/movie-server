<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Get all category
     * api/admin/category | get
     */
    public function index()
    {
        $categories = Category::all();

        return response_success([
            'categories' => $categories
        ]);
    }


    public function create()
    {
        //
    }

    /**
     * Create category
     * api/admin/category | post
     */
    public function store(Request $request)
    {
        $name_category = $request->input('cateName');

        $category = Category::create([
            'cate_name' => $name_category,
            'slug' => slugify($name_category)
        ]);

        return response_success([
            'category' => $category
        ],'created category success');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    /**
     * Update category by id
     * api/admin/category/id | put
     */
    public function update(Request $request, $id)
    {
        $cate_name = $request->input('cateName');
        $category = Category::findOrFail($id);
        if ($category) {
            $category ->update([
                'cate_name' => $cate_name,
                'slug' => slugify($cate_name)
            ]);
            return response_success([
                'category' => $category
            ],' updated category id ' . $id);
        }

        return response_error([],'category not found');

    }

    /**
     * Delete category by id
     * api/admin/category/id | delete
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if ($category) {
            $category->delete();

            return response_success([
                'categories' => $category
            ],'deleted use id ' . $id);
        }
        return response_error([], 'user not found');
    }
}
