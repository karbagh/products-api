<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SanctumMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->bearerToken() && Auth::guard('sanctum')?->user()) {
            Auth::setUser(
                Auth::guard('sanctum')?->user()
            );
        }

        return $next($request);
    }
}
