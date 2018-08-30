<?php

namespace App\Http\Controllers\Client;

use App\Models\Film;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnimeMovieController extends Controller
{
    /**
     * get highlight anime movie
     * api/public/film/anime/highlight | get
     */
    public function getHighlightAnimeMovie() {
        $movies = Film::with('image')
            ->whereHas('categories', function($q) {
                $q->where('categories.slug', 'anime');
            })
            ->orderByDesc('view')
            ->get();

        return response_success([
            'movies' => $movies
        ],'get highlight anime movie');
    }

    /**
     * get newest anime movie
     * api/public/film/anime/newest | get
     */
    public function getNewestAnimeMovie() {
        $movies = Film::with('image')
            ->whereHas('categories', function($q) {
                $q->where('categories.slug', 'anime');
            })
            ->orderByDesc('updated_at')
            ->get();

        return response_success([
            'movies' => $movies
        ],'get newest anime movie');
    }

    /**
     * get highlight anime action movie
     * api/public/film/anime/highlight-action | get
     */
    public function getHighlightAnimeActionMovie() {
        $movies = Film::with('image')
            ->whereHas('categories', function($q) {
                $q->where('categories.slug', 'anime');
            })
            ->whereHas('genres', function($q) {
                $q->where('genres.slug','phim-hanh-dong');
            })
            ->orderByDesc('view')
            ->get();

        return response_success([
            'movies' => $movies
        ],'get highlight anime action movie');
    }

    /**
     * get newest anime action movie
     * api/public/film/anime/newest-action | get
     */
    public function getNewestAnimeActionMovie() {
        $movies = Film::with('image')
            ->whereHas('categories', function($q) {
                $q->where('categories.slug', 'anime');
            })
            ->whereHas('genres', function($q) {
                $q->where('genres.slug','phim-hanh-dong');
            })
            ->orderByDesc('updated_at')
            ->get();

        return response_success([
            'movies' => $movies
        ],'get newest anime action movie');
    }

    /**
     * get highlight horror anime movie
     * api/public/film/anime/highlight-horror | get
     */
    public function getHighlightHorrorAnimeMovie(){
        $movies = Film::with('image')
            ->whereHas('categories', function($q) {
                $q->where('categories.slug', 'anime');
            })
            ->whereHas('genres', function($q) {
                $q->where('genres.slug','phim-kinh-di');
            })
            ->orderByDesc('view')
            ->get();

        return response_success([
            'movies' => $movies
        ],'get highlight anime horror movie');
    }

    /**
     * get newest horror anime
     * api/public/film/anime/newest-horror | get
     */
    public function getNewestHorrorAnimeMovie() {
        $movies = Film::with('image')
            ->whereHas('categories', function($q) {
                $q->where('categories.slug', 'anime');
            })
            ->whereHas('genres', function($q) {
                $q->where('genres.slug','phim-kinh-di');
            })
            ->orderByDesc('updated_at')
            ->get();

        return response_success([
            'movies' => $movies
        ],'get newest anime horror movie');
    }

    /**
     * get highlight science fiction anime
     * api/public/film/anime/highlight-sci-fi | get
     */
    public function getHighlightScienceFictionAnimeMovie() {
        $movies = Film::with('image')
            ->whereHas('categories', function($q) {
                $q->where('categories.slug', 'anime');
            })
            ->whereHas('genres', function($q) {
                $q->where('genres.slug','phim-khoa-hoc-vien-tuong');
            })
            ->orderByDesc('view')
            ->get();

        return response_success([
            'movies' => $movies
        ],'get highlight anime science fiction movie');
    }

    /**
     * get newest science fiction anime
     * api/public/film/anime/newest-sci-fi | get
     */
    public function getNewestScienceFictionAnimeMovie() {
        $movies = Film::with('image')
            ->whereHas('categories', function($q) {
                $q->where('categories.slug', 'anime');
            })
            ->whereHas('genres', function($q) {
                $q->where('genres.slug','phim-khoa-hoc-vien-tuong');
            })
            ->orderByDesc('updated_at')
            ->get();

        return response_success([
            'movies' => $movies
        ],'get newest anime science fiction movie');
    }
}
