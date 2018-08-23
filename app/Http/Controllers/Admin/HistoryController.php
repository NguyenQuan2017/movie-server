<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Film;
use App\Models\FilmInformation;
use App\Models\Genre;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class HistoryController extends Controller
{
    /**
     * get all list user is trashed
     * api/admin/history/user/delete | get
     */
    public function getUserDeleted() {
        $users_deleted = User::onlyTrashed()->get();
        return response_success( [
            'history_user' => $users_deleted
        ],'get data success');
    }

    /**
     * Restore user deleted by id
     * api/admin/history/user/restore/id | put
     */
    public function restoreUserDelete($id) {
        $users = User::withTrashed()
            ->find($id)
            ->restore();
        User::find($id)
            ->updateUserStatusRestore($id);
        return response_success([
            'users' => $users
        ]);
    }

    /**
     * force delete user is trashed
     * api/admin/history/user/delete/id | delete
     */
    public function deleteUser($id) {
        $user = User::withTrashed()
            ->find($id);
        if ($user) {
           $user->forceDelete();

           return response_success([],'deleted user id' . $id);
        }
        return response_error([],'user not found');

    }

    /**
     * get all list category is trashed
     * api/admin/history/category/list | get
     */
    public function getCategoryDelete() {
        $category_deleted = Category::onlyTrashed()->get();

        return response_success([
            'history_category' => $category_deleted
        ],'get data success');
    }

    /**
     * restore category is trashed by id
     * api/admin/history/category/restore/{id} | put
     */
    public function restoreCategory($id) {
        $category = Category::withTrashed()
            ->find($id);
        if ($category) {
            $category->restore();

            return response_success([
            ],'restored category id ' . $id);
        }

        return response_error([],'category not found');


    }

    /**
     * force delete category by id
     * api/admin/history/category/delete/{id} | delete
     */
    public function forceDeleteCategory($id) {
        $category = Category::withTrashed()->find($id);
        if ($category) {
            $category->forceDelete();

            return response_success(['deleted category id '. $id]);
        }

        return response_error([],'category not found');
    }

    /**
     * get list genre remove
     * api/admin/history/genre/list | get
     */
    public function getListGenreRemove(){
        $history_genres = Genre::onlyTrashed()->get();

        return response_success([
            'history_genres' => $history_genres
        ]);
    }

    /**
     * restore genre is removed
     * api/admin/history/genre/restore/{id} | put
     */
    public function restoreGenre($id) {
        $genre = Genre::withTrashed()->findOrFail($id);
        if ($genre) {
            $genre->restore();

            return response_success([
                'genre' => $genre
            ],'restored genre id ' . $id);
        }
        return response_error([],'genre not found');
    }

    /**
     * force delete genre
     * api/admin/history/genre/delete/{id} | delete
     */
    public function forceDeleteGenre($id) {
        $genre = Genre::withTrashed()->findOrFail($id);
        if ($genre) {
            $genre->forceDelete();

            return response_success([
                'genre' => $genre
            ],'deleted genre id ' . $id);
        }
        return response_error([],'genre id not found');
    }

    /**
     * get all list film remove
     * api/admin/history/film/list | get
     */
    public function getListFilmRemove() {
        $history_films = Film::onlyTrashed()->with('image')->get();

        return response_success([
            'history_films' => $history_films
        ],'get data success');
    }

    /**
     * restore film was deleted
     * api/admin/history/film/restore/{id} | put
     */
    public function restoreFilm($id) {
        $film = Film::withTrashed()->findOrFail($id);

        if ($film) {
            $film->restore();
            return response_success([
                'film' => $film
            ],'restored film id ' . $id);
        }

        return response_error([],'film id not found');
    }

    /**
     * force delete film
     * api/admin/history/film/delete/{id} | delete
     */
    public function deleteFilm($id) {
        $film = Film::withTrashed()->findOrFail($id);
        if ($film) {
            $film->forceDelete();
            return response_success([
                'film' => $film
            ],'deleted film id ' . $id);
        }

        return response_error([],'film id not found');
    }

    /**
     * get list image removed
     * api/admin/history/image/list | get
     */
    public function getListImageOnTrashed() {
        $images = Image::onlyTrashed()->with('film')->get();

        return response_success([
            'history_images' => $images
        ]);
    }

    /**
     * restore image in trashed
     * api/admin/history/image/restore/{id} | put
     */
    public function restoreImage($id) {
        $image = Image::withTrashed()->findOrFail($id);

        if ($image) {
            $image->restore();

            return response_success([
                'image' => $image
            ],'restore image id '. $id);
        }

        return response_error([],'image id not found');
    }

    /**
     * force delete image in trashed
     * api/admin/history/image/delete/{id} | delete
     */
    public function forceDeleteImage($id) {
        $image = Image::withTrashed()->findOrFail($id);

        if ($image) {
           $image->forceDelete();

           return response_success([
               'image' => $image
           ],'delete image id ' . $id);
        }

        return response_error([],'image id not found');
    }

    /**
     *  get list information in trashed
     *  api/admin/history/information/list | get
     */
    public function getListInformationInTrashed() {
        $informations = FilmInformation::onlyTrashed()->with('film')->get();

        return response_success([
            'history_informations' => $informations
        ],'get information success');
    }

    /**
     * restore information in trashed
     * api/admin/history/information/restore/{id} | put
     */
    public function restoreInformation($id) {

        $information = FilmInformation::withTrashed()->findOrFail($id);
        if ($information) {
            $information->restore();

            return response_success([
                'information' => $information
            ],'restore information id' . $id);
        }
        return response_error([],'information id not found');
    }

    /**
     * force Delete information in trashed
     * api/admin/history/information/delete/{id} | delete
     */
    public function forceDeleteInformation($id) {
        $information = FilmInformation::withTrashed()->findOrFail($id);
        if($information) {
            $information->forceDelete();
            return response_success([
                'information' => $information
            ],'delete information id' . $id);
        }

        return response_error([],'information id not found');
    }
}
