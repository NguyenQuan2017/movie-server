<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix' => 'admin'
], function () {
    Route::post('login', 'AuthController@login');
    Route::post('refresh', 'AuthController@refresh');

    Route::group(['middleware' => ['jwt','admin']], function () {
        Route::get('me', 'AuthController@me');
        Route::Resource('user', 'Admin\UserController');
        Route::Resource('role', 'Admin\RoleController');
        Route::Resource('category','Admin\CategoryController');
        Route::Resource('genre','Admin\GenreController');
        Route::Resource('film','Admin\FilmController');
        Route::Resource('image', 'Admin\ImageController');
        Route::Resource('information', 'Admin\InformationController');
        Route::Resource('poster', 'Admin\PosterController');
        Route::Resource('actor','Admin\ActorController');
        Route::Resource('video','Admin\VideoController');
        Route::Resource('country','Admin\CountryController');
        Route::Resource('tag', 'Admin\TagController');
        Route::post('video/get-link', 'Admin\VideoController@getLink');
//        Route::put('testUpdate/{id}', 'Admin\UserController@testUpdate');
        Route::group(['prefix' => 'history'], function() {
            Route::group(['prefix' => 'user'], function() {
                Route::get('list','Admin\HistoryController@getUserDeleted');
                Route::delete('delete/{user}', 'Admin\HistoryController@deleteUser');
                Route::put('restore/{user}', 'Admin\HistoryController@restoreUserDelete');
            });

            Route::group(['prefix' => 'category'], function() {
                Route::get('list', 'Admin\HistoryController@getCategoryDelete');
                Route::put('restore/{category}', 'Admin\HistoryController@restoreCategory');
                Route::delete('delete/{category}','Admin\HistoryController@forceDeleteCategory');
            });

            Route::group(['prefix' => 'genre'], function() {
                Route::get('list', 'Admin\HistoryController@getListGenreRemove');
                Route::put('restore/{genre}', 'Admin\HistoryController@restoreGenre');
                Route::delete('delete/{genre}', 'Admin\HistoryController@forceDeleteGenre');
            });

            Route::group(['prefix' => 'film'], function () {
                Route::get('list', 'Admin\HistoryController@getListFilmRemove');
                Route::put('restore/{film}', 'Admin\HistoryController@restoreFilm');
                Route::delete('delete/{genre}', 'Admin\HistoryController@deleteFilm');
            });

            Route::group(['prefix' => 'image'], function() {
                Route::get('list', 'Admin\HistoryController@getListImageOnTrashed');
                Route::put('restore/{film}', 'Admin\HistoryController@restoreImage');
                Route::delete('delete/{film}', 'Admin\HistoryController@forceDeleteImage');
            });

            Route::group(['prefix' => 'information'], function() {
                Route::get('list', 'Admin\HistoryController@getListInformationInTrashed');
                Route::put('restore/{information}', 'Admin\HistoryController@restoreInformation');
                Route::delete('delete/{information}', 'Admin\HistoryController@forceDeleteInformation');
            });

        });
        Route::post('logout', 'AuthController@logout');
    });
});

Route::group([
    'prefix' => 'public'
], function () {
    Route::get('category','Client\CategoryController@getCategories')->name('category.list');
    Route::group(['prefix' => 'film'], function() {
       Route::get('highlight', 'Client\FilmController@getHighLightFilm');
       Route::get('highlight/first', 'Client\FilmController@getHighLightFilmFirst');
       Route::get('information/{slug}', 'Client\FilmController@getInformationFilm');
       Route::get('related/{slug}','Client\FilmController@getRelatedFilm');
       Route::get('video/{slug}', 'Client\FilmController@getVideoFilm');
       Route::get('the-loai/{cate}/{genre}', 'Client\FilmController@getListMovieByGenre');
       Route::get('change-to-slug/{name}', 'Client\FilmController@changeToSlug');
       Route::get('search/{keyword}', 'Client\FilmController@searchMovie');
       Route::group(['prefix' => 'phim-le'], function() {
           Route::get('newest', 'Client\MovieController@getNewestMovie');
           Route::get('highlight', 'Client\MovieController@getHighlightMovie');
           Route::get('highlight-action', 'Client\MovieController@getHighlightActionMovie');
           Route::get('newest-action', 'Client\MovieController@getNewestActionMovie');
           Route::get('highlight-horror', 'Client\MovieController@getHighlightHorrorMovie');
           Route::get('newest-horror', 'Client\MovieController@getNewestHorrorMovie');
           Route::get('highlight-drama', 'Client\MovieController@getHighlightDramaMovie');
           Route::get('newest-drama', 'Client\MovieController@getNewestDramaMovie');
           Route::get('highlight-science-fiction', 'Client\MovieController@getHighlightScienceFictionMovie');
           Route::get('newest-science-fiction', 'Client\MovieController@getNewestScienceFictionMovie');
       });
       Route::group(['prefix' => 'phim-bo'], function() {
           Route::get('newest','Client\SeriesMovieController@getNewestSeriesMovie');
           Route::get('highlight', 'Client\SeriesMovieController@getHighlightSeriesMovie');
           Route::get('highlight-usa', 'Client\SeriesMovieController@getHighlightUsaSeriesMovie');
           Route::get('newest-usa', 'Client\SeriesMovieController@getNewestUsaSeriesMovie');
           Route::get('highlight-korea', 'Client\SeriesMovieController@getHighlightKoreaMovie');
           Route::get('newest-korea', 'Client\SeriesMovieController@getNewestKoreaMovie');
           Route::get('highlight-thailan','Client\SeriesMovieController@getHighlightThailanMovie');
           Route::get('newest-thailan','Client\SeriesMovieController@getNewestThailanMovie');
           Route::get('highlight-vietnam','Client\SeriesMovieController@getHighlightVietnamMovie');
           Route::get('newest-vietnam','Client\SeriesMovieController@getNewestVietnamMovie');
           Route::get('highlight-china','Client\SeriesMovieController@getHighlightChinaMovie');
           Route::get('newest-china','Client\SeriesMovieController@getNewestChinaMovie');
       });
       Route::group(['prefix' => 'phim-chieu-rap'], function() {
           Route::get('newest', 'Client\TheaterMovieController@getNewestTheaterMovie');
           Route::get('highlight', 'Client\TheaterMovieController@getHighlightTheaterMovie');
           Route::get('highlight-korea', 'Client\TheaterMovieController@getHighlightKoreaTheaterMovie');
           Route::get('newest-korea', 'Client\TheaterMovieController@getNewestKoreaTheaterMovie');
           Route::get('highlight-vn', 'Client\TheaterMovieController@getHighlightVnTheaterMovie');
           Route::get('newest-vn', 'Client\TheaterMovieController@getNewestVnTheaterMovie');
           Route::get('highlight-usa', 'Client\TheaterMovieController@getHighlightUsaTheaterMovie');
           Route::get('newest-usa', 'Client\TheaterMovieController@getNewestUsaTheaterMovie');
       });
       Route::group(['prefix' => 'anime'], function(){
           Route::get('highlight', 'Client\AnimeMovieController@getHighlightAnimeMovie');
           Route::get('newest', 'Client\AnimeMovieController@getNewestAnimeMovie');
           Route::get('highlight-action', 'Client\AnimeMovieController@getHighlightAnimeActionMovie');
           Route::get('newest-action', 'Client\AnimeMovieController@getNewestAnimeActionMovie');
           Route::get('highlight-horror', 'Client\AnimeMovieController@getHighlightHorrorAnimeMovie');
           Route::get('newest-horror', 'Client\AnimeMovieController@getNewestHorrorAnimeMovie');
           Route::get('highlight-sci-fi', 'Client\AnimeMovieController@getHighlightScienceFictionAnimeMovie');
           Route::get('newest-sci-fi', 'Client\AnimeMovieController@getNewestScienceFictionAnimeMovie');
       });
    });
});
