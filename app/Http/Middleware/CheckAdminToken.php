<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckAdminToken
{
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
            throw $e;
        }
        return $next($request);
    }
}
