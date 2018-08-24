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

    public function poster()
    {
        return $this->hasOne(Poster::class);
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

}
