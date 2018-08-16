<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilmInformation extends Model
{
    protected  $table = 'film_information';

    public function film()
    {
        return $this->belongsTo(Film::class);
    }
}
