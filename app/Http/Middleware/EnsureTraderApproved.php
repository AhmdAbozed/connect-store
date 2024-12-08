<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class EnsureTraderApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //login, signup, verify are allowed for pending
        ////login redirects to home which isn't allowed though
        if($request->is(['verify', 'user/*']) ||Route::current()->getPrefix() === 'admin'){
            
            error_log('pending next');
            return $next($request);
        }
        //error_log('user'.json_encode($request->user()));
        //error_log('user check'.Auth::check());
        
        //user is pending, and not at /pending
        if ($request->user() && $request->user()->type =='pending' && !$request->is(['pending'])) {

            error_log('pending trader');
            return redirect()->route('pendingTrader');
            
        }
        //user is pending and at /pending
        else{
            
            error_log('pending next at /pending');
                return $next($request);
            
        }
    }
}
