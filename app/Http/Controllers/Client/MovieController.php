<?php

namespace App\Http\Controllers\Client;

use App\Models\Film;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MovieController extends Controller
{

    /**
     * get newest movie | get
     * api/public/film/phim-le/newest | get
     */
    public function getNewestMovie() {
        $movies = Film::with('categories','image')
            ->whereHas('categories', function($query) {
                $query->where('slug', 'phim-le');
            })
            ->orderByDesc('updated_at')
            ->get();

        return response_success([
            'movies' => $movies
        ],'get newest movie ');
    }

    /**
     * get highlight movie | get
     * api/public/film/phim-le/highlight | get
     */
    public function getHighlightMovie() {
        $movies = Film::with('image')
            ->whereHas('categories', function($q) {
                $q->where('slug', 'phim-le');
            })
            ->orderByDesc('view')
            ->get();

        return response_success([
            'movies' => $movies
        ],'get highlight movie');
    }

    /**
     * get highlight action movie | get
     * api/public/film/phim-le/highlight-action | get
     */
    public function getHighlightActionMovie(){
        $movies = Film::with('image')
            ->whereHas('categories',function($q) {
                $q->where('slug','phim-le');
            })
            ->whereHas('genres', function($q){
                $q->where('slug','phim-hanh-dong');
            })
            ->orderByDesc('view')
            ->get();

        return response_success([
            'movies' => $movies
        ],'get highlight action movie');
    }

    /**
     * get newest action movie | get
     * api/public/film/phim-le/newest-action | get
     */
    public function getNewestActionMovie() {
        $movies = Film::with('image')
            ->whereHas('categories',function($q) {
                $q->where('slug','phim-le');
            })
            ->whereHas('genres', function($q){
                $q->where('slug','phim-hanh-dong');
            })
            ->orderByDesc('updated_at')
            ->get();

        return response_success([
            'movies' => $movies
        ],'get newest action movie');
    }

    /**
     * get highlight horror movie
     * api/public/film/phim-le/highlight-horror | get
     */
    public function getHighlightHorrorMovie() {
        $movies = Film::with('image')
            ->whereHas('categories',function($q) {
                $q->where('slug','phim-le');
            })
            ->whereHas('genres', function($q){
                $q->where('slug','phim-kinh-di');
            })
            ->orderByDesc('view')
            ->get();

        return response_success([
            'movies' => $movies
        ],'get highlight horror movie');
    }

    /**
     * get newest horror movie
     * api/public/film/phim-le/newest-horror | get
     */
    public function getNewestHorrorMovie() {
        $movies = Film::with('image')
            ->whereHas('categories',function($q) {
                $q->where('slug','phim-le');
            })
            ->whereHas('genres', function($q){
                $q->where('slug','phim-kinh-di');
            })
            ->orderByDesc('updated_at')
            ->get();

        return response_success([
            'movies' => $movies
        ],'get newest horror movie');
    }

    /**
     * get highlight drama movie
     * api/public/film/phim-le/highlight-drama | get
     */
    public function getHighlightDramaMovie() {
        $movies = Film::with('image')
            ->whereHas('categories',function($q) {
                $q->where('slug','phim-le');
            })
            ->whereHas('genres', function($q){
                $q->where('slug','phim-tam-ly');
            })
            ->orderByDesc('view')
            ->get();

        return response_success([
            'movies' => $movies
        ],'get highlight drama movie');
    }

    /**
     * get newest drama movie
     * api/public/film/phim-le/newest-drama | get
     */
    public function getNewestDramaMovie(){
        $movies = Film::with('image')
            ->whereHas('categories',function($q) {
                $q->where('slug','phim-le');
            })
            ->whereHas('genres', function($q){
                $q->where('slug','phim-tam-ly');
            })
            ->orderByDesc('updated_at')
            ->get();

        return response_success([
            'movies' => $movies
        ],'get newest drama movie');
    }

    /**
     * get highlight science fiction movie
     * api/public/film/phim-le/highlight-science-fiction | get
     */
    public function getHighlightScienceFictionMovie() {
        $movies = Film::with('image')
            ->whereHas('categories',function($q) {
                $q->where('slug','phim-le');
            })
            ->whereHas('genres', function($q){
                $q->where('slug','phim-khoa-hoc-vien-tuong');
            })
            ->orderByDesc('view')
            ->get();

        return response_success([
            'movies' => $movies
        ],'get highlight Science fiction movie');
    }

    /**
     * get newest science fiction move
     * api/public/film/phim-le/newest-science-fiction | get
     */
    public function getNewestScienceFictionMovie() {
        $movies = Film::with('image')
            ->whereHas('categories',function($q) {
                $q->where('slug','phim-le');
            })
            ->whereHas('genres', function($q){
                $q->where('slug','phim-khoa-hoc-vien-tuong');
            })
            ->orderByDesc('updated_at')
            ->get();

        return response_success([
            'movies' => $movies
        ],'get newest Science fiction movie');
    }

}
