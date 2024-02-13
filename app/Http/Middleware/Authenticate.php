<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        //get http referer url
        $referer = $request->headers->get('referer');
        // check if referer contains word expert
        if (str_contains($referer, 'expert')) {
            return $request->expectsJson() ? null : route('login', ['type' => 'expert']);
        }
        return $request->expectsJson() ? null : route('login', ['type' => 'client']);
    }
}
