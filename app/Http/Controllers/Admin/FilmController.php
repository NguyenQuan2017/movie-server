<?php

namespace App\Http\Controllers\Admin;

use App\Models\Film;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class FilmController extends Controller
{
    /**
     * get all list film
     * api/admin/film | get
     */
    public function index()
    {
        $films = Film::with('image')->orderByDesc('id')->paginate(10);

        return response_success([
            'films' => $films
        ],'get data success');
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
        $film_name = $request->input('filmName');
        $film_name_el = $request->input('filmNameEl');
        $description = $request->input('description');
        $file = $request->input('image');
        $file = decodeImageBase64($file);
        $data = $file['data'];
        $path = "uploads/films/" .date('Ymd');
        $extension = $file['extension'];
        $file_name = date('Ymd') . '-' .time()*1000 . '-' . \faker()->uuid. '-' . slugify($film_name_el) . '.' . $extension;
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        Storage::disk('public')->put($path . '/' .$file_name, $data);
        $imagePath = Storage::url( 'uploads/films/'.$file_name);
        $imageFullPath = 'http://movieserver.localhost:8081' . $imagePath;
        $film = Film::create([
            'film_name' => $film_name,
            'film_name_el' => $film_name_el,
            'slug' => slugify($film_name),
            'description' => $description
        ]);

        $image = new Image();
        $image->image_name = $film_name_el;
        $image->slug = slugify($film_name_el);
        $image->link = $imageFullPath;
        $film->image()->save($image);

        return response_success([
            'film' => $film
        ],'created film success');
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
        $film_name = $request->input('filmName');
        $film_name_el = $request->input('filmNameEl');
        $description = $request->input('description');
        $film = Film::findOrFail($id);

        $film->update([
            'film_name' => $film_name,
            'film_name_el' => $film_name_el,
            'slug' => slugify($film_name),
            'description' => $description
        ]);

        return response_success([
            'film' => $film
        ],'update film success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $film = Film::findOrFail($id);

        if ($film) {
            $film->image->delete();
            $film->delete();
            return response_success([
                'film' => $film
            ],'deleted film id' . $id);
        }
        return response_error([],'film id not found');
    }
}
