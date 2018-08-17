<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;

    protected $table = 'images';

    protected $fillable = ['image_name','slug', 'link','film_id'];

    public function film()
    {
        return $this->belongsTo(Film::class);
    }
}
