<?php

namespace App\Http\Controllers\Client;

use App\Models\Film;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeriesMovieController extends Controller
{
    /**
     * get newest movie
     * api/public/film/phim-bo/newest | get
     */
     public function getNewestSeriesMovie() {
         $movies = Film::with( 'image')
             ->whereHas('categories', function ($q){
                 $q->where('categories.slug','phim-bo');
             })
             ->orderByDesc('created_at')
             ->get();

         return response_success([
             'movies' => $movies
         ],'get newest series movie success');
     }

    /**
     * get highlight movie
     * api/public/film/phim-bo/highlight | get
     */
    public function getHighlightSeriesMovie() {
        $movies = Film::with('image')
            ->whereHas('categories', function ($q){
                $q->where('categories.slug','phim-bo');
            })->orderByDesc('view')
            ->orderByDesc('created_at')
            ->get();

        return response_success([
            'movies' => $movies
        ],'get movies success');
    }

    /**
     * get usa highlight movie
     * api/public/film/phim-bo/highlight-usa
     */
    public function getHighlightUsaSeriesMovie() {
        $movies = Film::with('image')
            ->whereHas('countries', function($q) {
                $q->where('countries.slug', 'my');
            })
            ->whereHas('categories', function($q) {
                $q->where('categories.slug', 'phim-bo');
            })
            ->orderByDesc('view')
            ->get();

        return response_success([
            'movies' => $movies
        ],'get use highlight movie success');
    }

    /**
     * get usa newest movie
     * api/public/film/phim-bo/newest-usa
     */
    public function getNewestUsaSeriesMovie() {
        $movies = Film::with('image')
            ->whereHas('countries', function($q) {
                $q->where('countries.slug', 'my');
            })
            ->whereHas('categories', function($q) {
                $q->where('categories.slug', 'phim-bo');
            })
            ->orderByDesc('created_at')
            ->get();

        return response_success([
            'movies' => $movies
        ],'get usa newest movie success');

    }

    /**
     * get korea highlight movie
     * api/public/film/phim-bo/highlight-korea
     */
    public function getHighlightKoreaMovie() {
        $movies = Film::with('image')
            ->whereHas('countries', function($q) {
                $q->where('countries.slug', 'han-quoc');
            })
            ->whereHas('categories', function($q) {
                $q->where('categories.slug', 'phim-bo');
            })
            ->orderByDesc('view')
            ->get();

        return response_success([
            'movies' => $movies
        ],'get korea highlight movie success');
    }

    /**
     * get korea newest movie
     * api/public/film/phim-bo/newest-korea
     */
    public function getNewestKoreaMovie() {
        $movies = Film::with('image')
            ->whereHas('countries', function($q) {
                $q->where('countries.slug', 'han-quoc');
            })
            ->whereHas('categories', function($q) {
                $q->where('categories.slug', 'phim-bo');
            })
            ->orderByDesc('created_at')
            ->get();

        return response_success([
            'movies' => $movies
        ], 'get newest korea movies success');
    }

    /**
     * get thai lan highlight movie
     * api/public/film/phim-bo/highlight-thailan | get
     */
    public function getHighlightThailanMovie() {
        $movies = Film::with('image')
            ->whereHas('countries', function($q) {
                $q->where('countries.slug', 'thai-lan');
            })
            ->whereHas('categories', function($q) {
                $q->where('categories.slug', 'phim-bo');
            })
            ->orderByDesc('view')
            ->get();

        return response_success([
            'movies' => $movies
        ],'get highlight thai lan movie success');
    }

    /**
     * get thai lan newest movie
     * api/public/film/phim-bo/newest-thailan | get
     */
    public function getNewestThailanMovie() {
        $movies = Film::with('image')
            ->whereHas('countries', function($q) {
                $q->where('countries.slug', 'thai-lan');
            })
            ->whereHas('categories',function($q) {
                $q->where('categories.slug', 'phim-bo');
            })
            ->orderByDesc('updated_at')
            ->get();

        return response_success([
            'movies' => $movies
        ],'get newest thai lan movie success');
    }

    /**
     * get highlight vietnam movie
     * api/public/film/phim-bo/highlight-vietnam | get
     */
    public function getHighlightVietnamMovie() {
        $movies = Film::with('image')
            ->whereHas('categories', function($q) {
                $q->where('categories.slug', 'phim-bo');
            })
            ->whereHas('countries', function($q) {
                $q->where('countries.slug', 'viet-nam');
            })
            ->orderByDesc('view')
            ->get();

        return response_success([
            'movies' => $movies
        ], 'get highlight vietnam move');
    }

    /**
     * get newest vietnam movie
     * api/public/film/phim-bo/newest-vietnam | get
     */
    public function getNewestVietnamMovie() {
        $movies = Film::with('image')
            ->whereHas('categories', function($q) {
                $q->where('categories.slug', 'phim-bo');
            })
            ->whereHas('countries', function($q) {
                $q->where('countries.slug', 'viet-nam');
            })
            ->orderByDesc('updated_at')
            ->get();

        return response_success([
            'movies' => $movies
        ], 'get newest vietnam movie');
    }

    /**
     * get highlight china movie
     * api/public/film/phim-bo/highlight-china | get
     */
    public function getHighlightChinaMovie() {
        $movies = Film::with('image')
            ->whereHas('categories', function($q) {
                $q->where('categories.slug', 'phim-bo');
            })
            ->whereHas('countries', function($q) {
                $q->where('countries.slug', 'trung-quoc');
            })
            ->orderByDesc('view')
            ->get();

        return response_success([
            'movies' => $movies
        ],'get highlight china movie');
    }

    /**
     * get newest china movie
     * api/public/film/phim-bo/newest-china | get
     */
    public function getNewestChinaMovie() {
        $movies = Film::with('image')
            ->whereHas('categories', function($q) {
                $q->where('categories.slug', 'phim-bo');
            })
            ->whereHas('countries', function($q) {
                $q->where('countries.slug', 'trung-quoc');
            })
            ->orderByDesc('updated_at')
            ->get();

        return response_success([
            'movies' => $movies
        ],'get newest china movie');
    }
}
