<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FilmInformation extends Model
{
    use SoftDeletes;

    protected  $table = 'film_information';

    protected $fillable = ['content','year','episode_number','high_definition','film_id','trailer','view'];

    public function film()
    {
        return $this->belongsTo(Film::class);
    }
}
