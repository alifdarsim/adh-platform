<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Config;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetUserTimezone
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $timezone = Auth::user()->timezone;
            if ($timezone) {
                Config::set('app.timezone', $timezone);
            }
        }

        return $next($request);
    }
}
