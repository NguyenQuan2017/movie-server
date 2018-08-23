<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $table = 'actors';

    protected $fillable = ['actor_name','character','slug','image','gender','country','birth_day'];

    public function films()
    {
        return $this->belongsToMany(Film::class);
    }
}
