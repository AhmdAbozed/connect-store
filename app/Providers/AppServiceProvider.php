<?php

namespace App\Providers;

use App\Services\BackBlazeService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $BackBlazeService = app(BackBlazeService::class);
        $downloadAuth = $BackBlazeService->getAuthorizationToken();
       
        Vite::macro('image', fn (string $asset) => asset("resources/images/{$asset}"));
        View::share('fileToken', $downloadAuth->authorizationToken);
        View::share('fileUrl', $downloadAuth->apiUrl);
    }
}
