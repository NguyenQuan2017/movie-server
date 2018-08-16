<?php

namespace App\Http\Controllers\Admin;

use App\Models\Genre;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = Genre::with('categories')->get();

        return response_success([
            'genres' => $genres
        ], 'get data success');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $genre_name = $request->input('genreName');
        $categories= $request->input('category');

        $genre = Genre::create([
            'genre_name' => $genre_name,
            'slug' => slugify($genre_name),
        ]);

        foreach($categories as $category) {
            $genre->categories()->attach($category);
        }

        return response_success([
            'genre' => $genre
        ],'created genre success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $genre_name = $request->input('genreName');
        $categories= $request->input('category');
        $genre = Genre::findOrFail($id);
        if ($genre) {
            $genre->update([
                'genre_name' => $genre_name,
                'slug' => slugify($genre_name),
            ]);


            $genre->categories()->sync($categories);

            return response_success([
                'genre' => $genre
            ],'update genre success');
        }

        return response_error([],'genre not found');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $genre = Genre::findOrFail($id);
        if($genre) {
            $genre->delete();

            return response_success([
                'genre' => $genre
            ],'deleted genre id '. $id);
        }
        return response_error([],'genre not found');
    }
}
