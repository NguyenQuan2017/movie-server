<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Film extends Model
{
    use SoftDeletes;

    protected $table = 'films';

    protected $fillable = ['film_name','film_name_el','slug','description'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function filmInformation()
    {
        return $this->hasOne(FilmInformation::class);
    }

    public function image()
    {
        return $this->hasOne(Image::class);
    }
}