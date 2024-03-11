<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Encore\Admin\Config\Config;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiLocaleMiddleware
{
    public function __construct()
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($locale = request()->header('Accept-Language')) {
            app()->setLocale(substr($locale, 0, 2));
            Carbon::setLocale(substr($locale, 0, 2));
        }

        return $next($request);
    }
}
