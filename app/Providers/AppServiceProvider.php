<?php

namespace App\Providers;

use App\Models\Admin\Resource;
use App\Observers\ResourceObserver;
use Illuminate\Support\Facades\App;
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
        App::setLocale('es');
        Resource::observe(ResourceObserver::class);
    }
}
