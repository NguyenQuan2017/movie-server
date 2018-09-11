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
        $films = Film::with('image','categories','genres','countries','tags')
            ->orderByDesc('id')
            ->get();

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
        $no_episode = $request->input('episodeNumber');
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
        $imagePath = Storage::url('uploads/films/'. date('Ymd'). '/'.$file_name);
        $imageFullPath = 'http://movieserver.localhost:8081' . $imagePath;
        $categories = $request->input('category');
        $genres = $request->input('genre');
        $actors = $request->input('actor');
        $countries = $request->input('country');
        $tags = $request->input('tag');
        $film = Film::create([
            'film_name' => $film_name,
            'film_name_el' => $film_name_el,
            'slug' => slugify($film_name),
            'description' => $description,
            'no_episode' => $no_episode,
            'view' => 0
        ]);

        //attach id category
        foreach ($categories as $category) {
            $film->categories()->attach($category);
        }

        //attach id genre
        foreach ($genres as $genre) {
            $film->genres()->attach($genre);
        }

        //attach id actor
        foreach($actors as $actor) {
            $film->actors()->attach($actor);
        }

        //attach id country
        foreach ($countries as $country) {
            $film->countries()->attach($country);
        }

        //attach id tag
        foreach ($tags as $tag) {
            $film->tags()->attach($tag);
        }

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
     * update film by id
     * api/admin/film/{id} | put
     */
    public function update(Request $request, $id)
    {
        $film_name = $request->input('filmName');
        $film_name_el = $request->input('filmNameEl');
        $description = $request->input('description');
        $no_episode = $request->input('episodeNumber');
        $categories = $request->input('category');
        $genres = $request->input('genre');
        $actors = $request->input('actor');
        $countries = $request->input('country');
        $tags = $request->input('tag');
        $film = Film::findOrFail($id);

        $film->update([
            'film_name' => $film_name,
            'film_name_el' => $film_name_el,
            'slug' => slugify($film_name),
            'description' => $description,
            'no_episode' => $no_episode
        ]);

        //sync id category
        $film->categories()->sync($categories);

        //sync id genre
        $film->genres()->sync($genres);

        //sync id actor
        $film->actors()->sync($actors);

        //sync id country
        $film->countries()->sync($countries);

        //sync id tag
        $film->tags()->sync($tags);

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
//            $film->filmInformation->delete() ? $film->filmInformation->delete() : null;
            $film->image->delete();
            $film->delete();
            return response_success([
                'film' => $film
            ],'deleted film id' . $id);
        }
        return response_error([],'film id not found');
    }


}
