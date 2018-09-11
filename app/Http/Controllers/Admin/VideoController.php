<?php

namespace App\Http\Controllers\Admin;

use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    /**
     * get list video
     * api/admin/video | get
     */
    public function index()
    {
        $videos = Video::with('film')->orderByDesc('id')->get();

        return response_success([
            'videos' => $videos
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
     * create video
     * api/admin/video | post
     */
    public function store(Request $request)
    {
        $title = $request->input('title');
        $episode = $request->input('episodeNumber');
        $film_id = $request->input('filmName');
        $file = $request->input('image');
//        $type = getFileTypeVideo($link_video);
        $file = decodeImageBase64($file);
        $data = $file['data'];
        $imageFullPath = '';
        if ($data) {
            $path = "uploads/films/videos/poster/" . date('Ymd');
            $extension = $file['extension'];
            $file_name = date('Ymd') . '-' . time() * 1000 . '-' . \faker()->uuid . '-' . slugify($title) . '.' . $extension;
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            Storage::disk('public')->put($path . '/' . $file_name, $data);
            $imagePath = Storage::url('uploads/films/videos/poster/' . date('Ymd') . '/' . $file_name);
            $imageFullPath = 'http://movieserver.localhost:8081' . $imagePath;

        }
        $link = $request->input('link_video');
        $sources = getPhotoGoogle($link);
        $video = Video::create([
            'title' => $title,
            'sources' => $sources,
            'link' => $link,
            'episode' => $episode,
            'film_id' => $film_id,
            'poster' => $imageFullPath
        ]);
        return response_success([
            'video' => $video
        ], 'create video success');

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
     * update video
     * api/admin/video/{id} | put
     */
    public function update(Request $request, $id)
    {
        $title = $request->input('title');
        $episode = $request->input('episodeNumber');
        $film_id = $request->input('filmName');
        $file = $request->input('image');
//        $type = getFileTypeVideo($link_video);
        $file = decodeImageBase64($file);
        $data = $file['data'];
        $imageFullPath = '';
        if ($data) {
            $path = "uploads/films/videos/poster/" . date('Ymd');
            $extension = $file['extension'];
            $file_name = date('Ymd') . '-' . time() * 1000 . '-' . \faker()->uuid . '-' . slugify($title) . '.' . $extension;
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            Storage::disk('public')->put($path . '/' . $file_name, $data);
            $imagePath = Storage::url('uploads/films/videos/poster/' . date('Ymd') . '/' . $file_name);
            $imageFullPath = 'http://movieserver.localhost:8081' . $imagePath;
        }
        $link = $request->input('link_video');
        $sources = getPhotoGoogle($link);
        $video = Video::findOrFail($id);

        if ($video) {
            $video->update([
                'title' => $title,
                'link' => $link,
                'sources' => $sources,
                'episode' => $episode,
                'film_id' => $film_id,
                'poster' => $imageFullPath
            ]);

            return response_success([
                'video' => $video
            ],'updated data success');
        }

        return response_error([],'video is not found');
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

    public function getLink(Request $request) {
        $url = $request->input('link_video');
        $sources = getPhotoGoogle($url);
        return response_success([
            'sources' => $sources
        ]);
    }
}
