<?php
/**
 * Created by PhpStorm.
 * User: quan
 * Date: 24/07/2018
 * Time: 11:02
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()){

            if (Auth::user()->isAdmin()){
                return $next($request);
            }
        }
        return response_error([],'user is not permission');
    }
}