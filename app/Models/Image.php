<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    protected $fillable = ['image_name','slug', 'link','film_id'];

    public function film()
    {
        return $this->belongsTo(Film::class);
    }
}
