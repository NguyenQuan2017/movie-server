<?php
/**
 * Created by PhpStorm.
 * User: quan
 * Date: 24/07/2018
 * Time: 11:46
 */

namespace App\Http\Middleware;

use JWTAuth;
use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;


class VerifyJWTToken
{
    public function handle($request, Closure $next)
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response_error([], 'User not found', 404);
            }
        } catch (TokenBlacklistedException $e) {

            return response_error([], 'The token has been blacklisted');

        } catch (TokenExpiredException $e) {
            return response_error([], 'The token expired');

        } catch (TokenInvalidException $e) {

            return response_error([], 'The token Invalid');

        } catch (JWTException $e) {

            return response_error([], 'The token absent');

        }
        return $next($request);
    }
}