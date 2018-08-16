<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genre extends Model
{
    use SoftDeletes;

    protected $table = 'genres';

    protected $fillable = ['genre_name','slug'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function films()
    {
        return $this->belongsToMany(Film::class);
    }
}
