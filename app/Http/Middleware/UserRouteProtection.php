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
        if ($userType === null) {
            return redirect()->route('login.index', 'expert');
        }
        $allowedUserTypes = ['admin', 'client', 'expert'];
        foreach ($allowedUserTypes as $type) {
            $routePrefix = $type . '/*';
            if ($userType !== $type && $request->is($routePrefix)) {
                $route = $userType == 'admin' ? 'admin.overview.index' : ($userType == 'client' ? 'client.overview.index' : 'expert.overview.index');
                return redirect()->route($route);
            }
        }
        return $next($request);
    }
}
