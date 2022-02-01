<?php

namespace App\Http\Middleware;

use App\Traits\GeneralTraits;
use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckAdminToken
{
    use GeneralTraits;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = null;
        try {
            $user = JWTAuth::parseToken()->authentication();
        } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return $this->returnError('500','Invalid_Token');
            } elseif ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return $this->returnError('400','Expired_Token');
            } else {
                return $this->returnError('404','Token_NotFound'); 
            }
        } catch (\Throwable $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return $this->returnError('500','Invalid_Token');
            } elseif ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return $this->returnError('400','Expired_Token');
            } else {
                return $this->returnError('404','Token_NotFound');
            }
        }
        if(!$user){
            return $this->returnError('403','Unauthentication');
        }
        return $next($request);
    }
}
