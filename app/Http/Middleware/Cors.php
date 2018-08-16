<?php
/**
 * Created by PhpStorm.
 * User: quan
 * Date: 24/07/2018
 * Time: 14:02
 */

namespace App\Http\Middleware;
use Closure;


class Cors
{
    public function handle($request, Closure $next) {

        return $next($request)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Headers',' Origin, Content-Type, Accept, Authorization, X-Request-With')
            ->header('Access-Control-Allow-Credentials',' true');
    }
}