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

        return response_success( [
            'film' => $film
        ]);
    }

    public function getInformationFilm($slug) {
        $film = Film::with('categories','image','genres','filmInformation','actors')
        ->where('slug',$slug)
        ->first();

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

    //Phim bo


}
