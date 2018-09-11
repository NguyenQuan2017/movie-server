<?php

namespace App\Http\Controllers\Admin;

use App\Models\FilmInformation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InformationController extends Controller
{
    /**
     * Get all information film
     * api/admin/information | get
     */
    public function index()
    {
        $informations = FilmInformation::with('film')
            ->orderByDesc('id')
            ->get();

        return response_success([
            'informations' => $informations
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
    * create information for film
    * api/admin/information | post
    */
    public function store(Request $request)
    {
        $content = $request->input('content');
        $year = $request->input('year');
        $high_definition = $request->input('highDefinition');
        $episode_number = $request->input('episodeNumber');
        $trailer = $request->input('link_trailer');
        $film_id = $request->input('filmName');

        $information = FilmInformation::create([
            'content' => $content,
            'year' => $year,
            'high_definition' => $high_definition,
            'episode_number' => $episode_number,
            'trailer' => $trailer,
            'film_id' => $film_id
        ]);
        return response_success([
            'information' => $information
        ],'created data success');
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
     * update information film by id
     * api/admin/information/{id}  | put
     */
    public function update(Request $request, $id)
    {
        $content = $request->input('content');
        $year = $request->input('year');
        $high_definition = $request->input('highDefinition');
        $episode_number = $request->input('episodeNumber');
        $trailer = $request->input('link_trailer');
        $film_id = $request->input('filmName');

        $information = FilmInformation::findOrFail($id);
        $information->update([
            'content' => $content,
            'year' => $year,
            'high_definition' => $high_definition,
            'episode_number' => $episode_number,
            'trailer' => $trailer,
            'film_id' => $film_id
        ]);

        return response_success([
            'information' => $request->all()
        ],'updated information id ' . $id);
    }

    /**
     * remove information film by id
     * api/admin/information/{id} | delete
     */
    public function destroy($id)
    {
        $information = FilmInformation::findOrFail($id);

        if ($information) {
            $information->delete();

            return response_success([
                'information' => $information
            ],'removed information id' .$id);
        }

        return response_error([],'information id not found');
    }
}
