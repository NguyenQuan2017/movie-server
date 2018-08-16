<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'categories';
    protected $fillable = ['cate_name','slug'];

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function films()
    {
        return $this->belongsToMany(Film::class);
    }
}
