<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Symfony\Component\HttpFoundation\Response;

class UserRouteProtection
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): \Illuminate\Http\Response | RedirectResponse | Redirector | Response | JsonResponse
    {
        $userType = session('user_type');
        $allowedUserTypes = ['admin', 'client', 'expert'];
        foreach ($allowedUserTypes as $type) {
            $routePrefix = $type . '/*';
            if ($userType !== $type && $request->is($routePrefix)) {
                return response()->view('errors.unauthorized', [], 403);
            }
        }

        return $next($request);
    }

}
