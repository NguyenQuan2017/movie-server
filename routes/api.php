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

        });

//        Route::apiResource('category', 'CategoryController');
//        Route::apiResource('article', 'ArticleController');
        Route::post('logout', 'AuthController@logout');
    });
//    Route::group([
//        'prefix' => 'public'
//    ], function () {
//        Route::apiResource('category', 'CategoryController');
//        Route::apiResource('article', 'ArticleController');
//    });
});
