<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetUserLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // check if user is logged in
        if (!auth()->check()) {
            $language = $request->cookie('language');
            if ($language) \App::setLocale($language);
            return $next($request);
        }
        // get user language
        $language = auth()->user()->language;
        \App::setLocale($language);
        return $next($request);
    }
}
