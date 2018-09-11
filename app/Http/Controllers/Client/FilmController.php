<?php

namespace App\Http\Controllers\Client;

use App\Models\Film;
use App\Models\FilmInformation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FilmController extends Controller
{
    public function getHighLightFilm() {
        $films = Film::with('filmInformation','categories','genres','poster')
            ->skip(1)
            ->take(9)
            ->orderByDesc('view')
            ->get();
        return response_success([
            'films' => $films
        ],'get film success');
    }

    public function getHighLightFilmFirst() {
        $film = Film::with('filmInformation','categories','genres','poster')
            ->orderByDesc('view')
            ->first();

        $films = Film::with('filmInformation','categories','genres','poster')
            ->take(9)
            ->orderByDesc('view')
            ->where('id', '<>',$film->id)
            ->get();
        return response_success( [
            'film' => $film,
            'films' => $films
        ]);
    }

    public function getInformationFilm($slug) {
        $film = Film::with('categories','image','genres','filmInformation','actors','tags')
        ->where('slug',$slug)
        ->first();
        $view = $film->view;
//        dd($view);
        $film->update([
            'view' => $view + 1
        ]);

        $film->filmInformation()->update([
            'view' => $film->view + 1
        ]);

        return response_success([
            'film' => $film,
        ]);
    }

    public function getRelatedFilm($slug) {
        $film = Film::where('slug',$slug)
            ->first();
        $cate_id = $film->categories->modelKeys();
        $genre_id = $film->genres->modelKeys();
        $related = Film::with('categories', 'image','genres','filmInformation')
            ->whereHas('categories', function ($q) use ($cate_id) {
                $q->whereIn('categories.id', $cate_id);
            })
            ->whereHas('genres', function ($q) use ($genre_id) {
                $q->whereIn('genres.id', $genre_id);
            })
            ->where('films.id', '<>', $film->id)
            ->get();

        return response_success([
            'related' => $related
        ]);
    }

    public function getVideoFilm($slug) {
        $film = Film::with('videos')
            ->where('slug', $slug)
            ->first();

        return response_success([
            'film' =>$film
        ]);
    }

    /**
     * get list movie by genre
     * api/public/film/the-loai/{the-loai} | get
     */
    public function getListMovieByGenre($cate, $genre) {
        $movies = Film::with('image')
            ->orWhereHas('genres', function($q) use ($genre) {
                $q->where('genres.slug', $genre);
            })
            ->orWhereHas('countries', function($q) use ($genre) {
                $q->where('countries.slug', $genre);
            })
            ->whereHas('categories', function($q) use ($cate) {
                $q->where('categories.slug', $cate);
            })
            ->get();

        return response_success([
            'movies' => $movies
        ],'get movies ' . $genre);
    }

    /**
     * Search movie
     * api/public/film/search/{{keyword}} | get
     */
    public function searchMovie($keyword) {
        $movies = Film::with('image')
            ->where('slug','LIKE','%'.$keyword.'%')
            ->orWhere('film_name_el', 'LIKE','%'.$keyword.'%')
            ->get();

        return response_success([
            'movies' => $movies
        ],'list search movies');
    }

    /**
     * Change film name to slug name
     * api/public/film/change-to-slug/{name} | get
     */
    public function changeToSlug($name) {
        $slug = slugify($name);

        return response_success( [
            'slug' => $slug
        ]);
    }
}
