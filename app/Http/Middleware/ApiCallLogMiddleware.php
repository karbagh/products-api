<?php

namespace App\Http\Middleware;

use App\Repositories\OperationLog\OperationLogRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiCallLogMiddleware
{
    public function __construct(
        private readonly OperationLogRepository $repository
    )
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $this->repository->saveNewLog(
            Auth::user(),
            $request->path(),
            $request->method(),
            $request->ip(),
            json_encode($request->input()),
        );

        return $next($request);
    }
}
