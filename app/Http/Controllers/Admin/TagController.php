<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{

    /**
     * display list tag
     * api/admin/tag | get
     */
    public function index()
    {
        $tags = Tag::all();

        return response_success([
            'tags' => $tags
        ],' get all tags');
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
    * create tag
    * api/admin/tag | post
    */
    public function store(Request $request)
    {
       $tag_name = $request->input('tag');

       $tag = Tag::create([
           'tag_name' => $tag_name,
           'slug' => slugify($tag_name)
       ]);

        return response_success([
            'tag' => $tag
        ],'create tag success');
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


    public function edit($id)
    {
        //
    }

   /**
    * updated tag
    * api/admin/tag/{tag} | put
    */
    public function update(Request $request, $id)
    {
        $tag_name = $request->input('tag');
        $tag = Tag::findOrFail($id);
        $tag->update([
            'tag_name' => $tag_name,
            'slug' => slugify($tag_name)
        ]);
        return response_success([
            'tag' => $tag
        ],'updated tag id '.$id);
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
