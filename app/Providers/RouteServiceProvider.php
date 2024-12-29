<?php

namespace App\Providers;

use config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $centeralDomains = $this->centeralDomains();

        $this->routes(function () use($centeralDomains) {
            foreach($centeralDomains as $domain){
                Route::middleware('api')
                    ->prefix('api')
                    ->domain($domain)
                    ->group(base_path('routes/api.php'));
                    
                    Route::middleware('web')
                        ->domain($domain)
                        ->group(base_path('routes/web.php'));
            }            
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }

    protected function centeralDomains(): array
    {
        return config('tenancy.centeral_domains', []); // Default to an empty array if null
    }
    

}
