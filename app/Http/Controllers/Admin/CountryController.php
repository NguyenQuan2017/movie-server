<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    /**
     * get list countries
     * api/admin/country | get
     */
    public function index()
    {
        $countries = Country::all();

        return response_success([
            'countries' => $countries
        ], 'get data success');
    }

    public function create()
    {
        //
    }

    /**
     * created country
     * api/admin/country | post
     */
    public function store(Request $request)
    {
        $name_country = $request->input('country');

        $country = Country::create([
            'country' => $name_country,
            'slug' => slugify($name_country)
        ]);

        return response_success([
            'country' => $country
        ],'created country success');
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
     * update country by id
     * api/admin/country/{id} | put
     */
    public function update(Request $request, $id)
    {
        $name_country = $request->input('country');
        $country = Country::findOrFail($id);

        if ($country) {
            $country->update([
                'country' => $name_country,
                'slug' => slugify($name_country)
            ]);

            return response_success([
                'country' => $country
            ],'updated country success');
        }
        return response_error([], 'country id not found');
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
