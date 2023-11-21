<?php

namespace App\Providers;

use App\Models\Tenants\SocialMedia;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        view()->composer('candidates.layouts.footer', function($view) {
            $view->with(['social_links' => SocialMedia::all()]);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
