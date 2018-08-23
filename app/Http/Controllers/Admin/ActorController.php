<?php

namespace App\Http\Controllers\Admin;

use App\Models\Actor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ActorController extends Controller
{
    /**
     * get lis actor
     * api/admin/actor | get
     */
    public function index()
    {
        $actors = Actor::orderByDesc('id')
                ->get();

        return response_success([
            'actors' => $actors
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
     * create actor
     * api/admin/actor | post
     */
    public function store(Request $request)
    {
        $actor_name = $request->input('actorName');
        $country = $request->input('country');
        $gender = $request->input('gender');
        $birth_day = $request->input('birth_day');
        $file = $request->input('image');
        $file = decodeImageBase64($file);
        $data = $file['data'];
        $path = "uploads/actors/" .date('Ymd');
        $extension = $file['extension'];
        $file_name = date('Ymd') . '-' .time()*1000 . '-' . \faker()->uuid. '-' . slugify($actor_name) . '.' . $extension;
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        Storage::disk('public')->put($path . '/' .$file_name, $data);
        $imagePath = Storage::url('uploads/actors/'. date('Ymd'). '/'.$file_name);
        $imageFullPath = 'http://movieserver.localhost:8081' . $imagePath;

        $actor = Actor::create([
            'actor_name' => $actor_name,
            'slug' => slugify($actor_name),
            'country' => $country,
            'gender' => $gender,
            'birth_day' => $birth_day,
            'image' => $imageFullPath
        ]);
        return response_success([
            'actor' => $actor
        ],' created actor success');
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
     * Update actor by id
     * api/admin/actor | put
     */
    public function update(Request $request, $id)
    {
        $actor_name = $request->input('actorName');
        $country = $request->input('country');
        $gender = $request->input('gender');
        $birth_day = $request->input('birth_day');
        $file = $request->input('image');
        $file = decodeImageBase64($file);
        $data = $file['data'];
        $path = "uploads/actors/" .date('Ymd');
        $extension = $file['extension'];
        $file_name = date('Ymd') . '-' .time()*1000 . '-' . \faker()->uuid. '-' . slugify($actor_name) . '.' . $extension;
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        Storage::disk('public')->put($path . '/' .$file_name, $data);
        $imagePath = Storage::url('uploads/actors/'. date('Ymd'). '/'.$file_name);
        $imageFullPath = 'http://movieserver.localhost:8081' . $imagePath;

        $actor = Actor::findOrFail($id);
        if ($actor) {
            $actor->update([
                'actor_name' => $actor_name,
                'slug' => slugify($actor_name),
                'country' => $country,
                'gender' => $gender,
                'birth_day' => $birth_day,
                'image' => $imageFullPath
            ]);
            return response_success([
                'actor' => $actor
            ],'updated actor success');
        }
        return response_error([],'actor is not found');

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
