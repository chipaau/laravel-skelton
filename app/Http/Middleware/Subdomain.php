<?php

namespace App\Http\Middleware;

use Closure;

class Subdomain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $subdomain = $request->route()->parameter('subdomain');
        if (in_array($subdomain, config('app.subdomains'))) {
            return $next($request);
        }

        abort(404);
    }
}
