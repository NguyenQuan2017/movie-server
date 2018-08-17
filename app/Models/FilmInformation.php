<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FilmInformation extends Model
{
    protected  $table = 'film_information';

    protected $fillable = ['content','year','episode_number','high_definition','film_id'];

    public function film()
    {
        return $this->belongsTo(Film::class);
    }
}
