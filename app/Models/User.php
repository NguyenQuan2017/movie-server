<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, SoftDeletes;

    protected  $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
//     */
    protected $fillable = [
        'user_name','avatar','first_name','last_name','user_status', 'email', 'password','created_at','updated_at','deleted_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class)->select('roles.id','name');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
       return [];
    }

    public function isAdmin(){
        return $this->roles()->where('name', 'admin')->exists();
    }

    public function updateUserStatusDeleted($id) {
      $users = User::onlyTrashed()->find($id)
                    ->update(['user_status' => 0]);
        return $users;
    }

    public function updateUserStatusRestore($id) {
        $users = User::withTrashed()->find($id)
                ->update(['user_status' => 1]);
        return $users;
    }
}
