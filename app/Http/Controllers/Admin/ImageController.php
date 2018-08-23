<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Faker\Factory as Faker;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::with('film')
            ->orderByDesc('id')
            ->get();

        return response_success([
            'images' => $images
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
        $image = Image::findOrFail($id);
        $image_name = $request->input('imageName');
        $file = $request->input('image');
        $file = decodeImageBase64($file);
        $data = $file['data'];
        if ($data) {
            $path = "uploads/films/" .date('Ymd');
            $extension = $file['extension'];
            $file_name = date('Ymd') . '-' .time()*1000 . '-' . \faker()->uuid. '-' . slugify($image_name) . '.' . $extension;
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            Storage::disk('public')->put($path . '/' .$file_name, $data);
            $imagePath = Storage::url( 'uploads/films/'.date('Ymd').'/'.$file_name);
            $imageFullPath = 'http://movieserver.localhost:8081' . $imagePath;

            $image->update([
                'image_name' => $image_name,
                'slug' => slugify($image_name),
                'link' => $imageFullPath
            ]);
        }
        $image->update([
            'image_name' => $image_name,
            'slug' => slugify($image_name),
        ]);

        return response_success([
            'image' => $image
        ]);
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
