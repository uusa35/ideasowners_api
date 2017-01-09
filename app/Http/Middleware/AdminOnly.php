<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Response;

class AdminOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()->admin) {

            return $next($request);

        }
        return response()->json(['message', 'admin zone'],400);
    }
}
