<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;

    protected $table = 'tags';
    protected $fillable = ['tag_name', 'slug'];

    public function films()
    {
        return $this->belongsToMany(Film::class);
    }
}
