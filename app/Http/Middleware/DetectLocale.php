<?php

namespace App\Http\Middleware;

use Closure;
use Config;
use App;

class DetectLocale
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
        //$locale = $request->header('Accept-Language');
        App::setLocale($request->header('Accept-Language'));
        return $next($request);
    }
}
