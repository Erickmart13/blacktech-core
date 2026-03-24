<?php

namespace App\Providers;

use App\Listeners\UpdateLastLogin;
use App\Models\Admin\Resource;
use App\Observers\ResourceObserver;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Event;
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
        Event::listen(Login::class, [UpdateLastLogin::class, 'handle']);
        Resource::observe(ResourceObserver::class);
    }
}
