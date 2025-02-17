<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureNumberVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->is('verify') || true) {
            return $next($request);
        }
        if ($request->user() && !$request->user()->number_verified_at) {
            // Redirect to the verification form if not verified
            return redirect()->route('verify');
        }

        //return $next($request);
    }
}
