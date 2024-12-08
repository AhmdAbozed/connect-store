<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        
        error_log($request->user());
        error_log('Session ID after hmm redirect: ' . session()->getId());
                
        error_log(Auth::check());
        error_log($request->expectsJson());
        return $request->expectsJson() ? null : route('login');
    }
}
