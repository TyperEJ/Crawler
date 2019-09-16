<?php

namespace App\Http\Middleware;

use Closure;

class CheckIsRegister
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
        $lineMember = auth('api')->user();

        if(!$lineMember)
        {
            return response()
                ->json('not found line member')
                ->setStatusCode(404);
        }

        return $next($request);
    }
}
