<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes;

    protected $table = 'videos';

    protected $fillable = ['title', 'sources', 'link', 'trailer', 'episode', 'film_id','poster'];
    protected $casts = [
        'sources' => 'json'
    ];
    public function film()
    {
        return $this->belongsTo(Film::class);
    }
}
