<?php

namespace App\Http\Middleware;

use App\Services\BackBlazeService;
use Cache;
use Closure;
use Illuminate\Http\Request;
use Schema;
use Symfony\Component\HttpFoundation\Response;
use View;
use Vite;

class AddBackblazeAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $BackBlazeService = app(BackBlazeService::class);
        
        if (Schema::hasTable('cache')) {
            $downloadAuth = Cache::remember('backblaze_auth_token', 3600, function () use ($BackBlazeService) {
                return $BackBlazeService->getAuthorizationToken();
            });    
        }else{
            $downloadAuth = $BackBlazeService->getAuthorizationToken();
        }
        
        Vite::macro('image', fn (string $asset) => asset("resources/images/{$asset}"));
        View::share('fileToken', $downloadAuth->authorizationToken);
        View::share('fileUrl', $downloadAuth->apiUrl);
        return $next($request);
    }
}
