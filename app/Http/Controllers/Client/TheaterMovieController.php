<?php

namespace App\Http\Controllers\Client;

use App\Models\Film;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TheaterMovieController extends Controller
{

    /**
     * get newest theater move
     * api/public/film/phim-chieu-rap/newest | get
     */
    public function getNewestTheaterMovie() {
        $movies = Film::with('image')
            ->whereHas('categories', function($q) {
                $q->where('categories.slug','phim-chieu-rap');
            })
            ->orderByDesc('updated_at')
            ->get();

        return response_success([
            'movies' => $movies
        ],'get newest theater movie');
    }

    /**
     * get highlight theater movie
     * api/public/film/phim-chieu-rap/highlight | get
     */
    public function getHighlightTheaterMovie() {
        $movies = Film::with('image')
            ->whereHas('categories', function($q) {
                $q->where('categories.slug','phim-chieu-rap');
            })
            ->orderByDesc('view')
            ->get();

        return response_success([
            'movies' => $movies
        ],'get highlight theater movie');
    }

    /**
     * get highlight theater korea movie
     * api/public/film/phim-chieu-rap/highlight-korea | get
     */
    public function getHighlightKoreaTheaterMovie() {
        $movies = Film::with('image')
            ->whereHas('categories', function($q) {
                $q->where('categories.slug','phim-chieu-rap');
            })
            ->whereHas('countries', function($q) {
                $q->where('countries.slug', 'han-quoc');
            })
            ->orderByDesc('view')
            ->get();

        return response_success([
            'movies' => $movies
        ],'get highlight korea theater movie');
    }

    /**
     * get newest theater korea movie
     * api/public/film/phim-chieu-rap/newest-korea | get
     */
    public function getNewestKoreaTheaterMovie() {
        $movies = Film::with('image')
            ->whereHas('categories', function($q) {
                $q->where('categories.slug','phim-chieu-rap');
            })
            ->whereHas('countries', function($q) {
                $q->where('countries.slug', 'han-quoc');
            })
            ->orderByDesc('updated_at')
            ->get();

        return response_success([
            'movies' => $movies
        ],'get newest korea theater movie');
    }

    /**
     * get highlight theater vietnam movie
     * api/public/film/phim-chieu-rap/highlight-vn | get
     */
    public function getHighlightVnTheaterMovie() {
        $movies = Film::with('image')
            ->whereHas('categories', function($q) {
                $q->where('categories.slug','phim-chieu-rap');
            })
            ->whereHas('countries', function($q) {
                $q->where('countries.slug', 'viet-nam');
            })
            ->orderByDesc('view')
            ->get();

        return response_success([
            'movies' => $movies
        ],'get highlight vn theater movie');
    }

    /**
     * get newest theater vietnam movie
     * api/public/film/phim-chieu-rap/newest-vn | get
     */
    public function getNewestVnTheaterMovie() {
        $movies = Film::with('image')
            ->whereHas('categories', function($q) {
                $q->where('categories.slug','phim-chieu-rap');
            })
            ->whereHas('countries', function($q) {
                $q->where('countries.slug', 'viet-nam');
            })
            ->orderByDesc('updated_at')
            ->get();

        return response_success([
            'movies' => $movies
        ],'get newest vn theater movie');
    }

    /**
     * get highlight usa theater movie
     * api/public/film/phim-chieu-rap/highlight-usa | get
     */
    public function getHighlightUsaTheaterMovie() {
        $movies = Film::with('image')
            ->whereHas('categories', function($q) {
                $q->where('categories.slug','phim-chieu-rap');
            })
            ->whereHas('countries', function($q) {
                $q->where('countries.slug', 'my');
            })
            ->orderByDesc('view')
            ->get();

        return response_success([
            'movies' => $movies
        ],'get highlight usa theater movie');
    }

    /**
     * get newest usa theater movie
     * api/public/film/phim-chieu-rap/newest-usa | get
     */
    public function getNewestUsaTheaterMovie() {
        $movies = Film::with('image')
            ->whereHas('categories', function($q) {
                $q->where('categories.slug','phim-chieu-rap');
            })
            ->whereHas('countries', function($q) {
                $q->where('countries.slug', 'my');
            })
            ->orderByDesc('updated_at')
            ->get();

        return response_success([
            'movies' => $movies
        ],'get newest usa theater movie');
    }
}
