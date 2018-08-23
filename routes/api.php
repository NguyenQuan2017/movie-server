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
       Route::group(['prefix' => 'phim-le'], function() {
           Route::get('newest', 'Client\FilmController@getNewestFilm');
       });

       Route::group(['prefix' => 'phim-chieu-rap'], function() {
           Route::get('newest', 'Client\FilmController@getNewestTheaterFilm');
       });
    });
});
