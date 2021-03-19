<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //redirect if not a admin
        if ($request->user()->role != "admin") {
            if ($request->wantsJson()) {
                return response()->json(['Message', 'You do not have access to this page.'], 403);
            }
            return abort(403, 'You do not have access to this page.');
        }

        return $next($request);
    }
}
