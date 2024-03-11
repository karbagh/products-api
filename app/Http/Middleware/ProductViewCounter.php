<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ProductViewCounter
{
    public function handle(Request $request, Closure $next)
    {
        if ($product = $request->route()->parameter('product')) {
            $product->increment('views', 1);
        }

        return $next($request);
    }
}
