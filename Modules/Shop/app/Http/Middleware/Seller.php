<?php

namespace Modules\Shop\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Seller
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if(!auth()->check() || !auth()->user()->is_seller) {
            abort(403);
        }

        return $next($request);
    }
}
