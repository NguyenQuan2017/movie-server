<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Poster extends Model
{
    use SoftDeletes;

    protected $table = 'posters';
    protected $fillable = ['poster_name', 'slug', 'link', 'film_id'];


    public function film()
    {
        return $this->belongsTo(Film::class);
    }
}
