<?php

namespace App\Http\Controllers\Admin;

use App\Models\Poster;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PosterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posters = Poster::with('film')
            ->orderByDesc('id')
            ->get();

        return response_success([
            'posters' => $posters
        ]);
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
        $image_name = $request->input('imageName');
        $file = $request->input('image');
        $film_id = $request->input('filmName');
        $file = decodeImageBase64($file);
        $data = $file['data'];
        if ($data) {
            $path = "uploads/films/poster/" . date('Ymd');
            $extension = $file['extension'];
            $file_name = date('Ymd') . '-' . time() * 1000 . '-' . \faker()->uuid . '-' . slugify($image_name) . '.' . $extension;
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            Storage::disk('public')->put($path . '/' . $file_name, $data);
            $imagePath = Storage::url('uploads/films/poster/' . date('Ymd') . '/' . $file_name);
            $imageFullPath = 'http://movieserver.localhost:8081' . $imagePath;

            $poster = Poster::create([
                'poster_name' => $image_name,
                'slug' => slugify($image_name),
                'link' => $imageFullPath,
                'film_id' => $film_id
            ]);

            return response_success([
                'poster' => $poster
            ],'create poster success');

        }
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
        $image_name = $request->input('imageName');
        $file = $request->input('image');
        $film_id = $request->input('filmName');
        $file = decodeImageBase64($file);
        $data = $file['data'];
        if ($data) {
            $path = "uploads/films/poster/" . date('Ymd');
            $extension = $file['extension'];
            $file_name = date('Ymd') . '-' . time() * 1000 . '-' . \faker()->uuid . '-' . slugify($image_name) . '.' . $extension;
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            Storage::disk('public')->put($path . '/' . $file_name, $data);
            $imagePath = Storage::url('uploads/films/poster/' . date('Ymd') . '/' . $file_name);
            $imageFullPath = 'http://movieserver.localhost:8081' . $imagePath;

            $poster = Poster::findOrFail($id);

            if ($poster) {
                $poster->update([
                    'poster_name' => $image_name,
                    'slug' => slugify($image_name),
                    'link' => $imageFullPath,
                    'film_id' => $film_id
                ]);

                return response_success([
                    'poster' => $poster
                ]);
            }

            return response_error([],'poster id not found');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
