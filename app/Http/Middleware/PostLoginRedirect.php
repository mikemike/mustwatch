<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PostLoginRedirect
{
    public function handle($request, Closure $next, $guard = null)
    {
        $response = $next($request);
        if (Auth::check() && isset($request->r)) {
             // Return the new route redirect.
             return redirect($request->r);
        }
        return $response;
    }
}