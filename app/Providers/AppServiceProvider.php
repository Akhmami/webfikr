<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\View\Composers\BreadcrumbComposer;
use App\View\Composers\NavbarComposer;
use App\View\Composers\PopupComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Fix for SwiftMailer Service;
        $_SERVER["SERVER_NAME"] = config('app.domain');
        View::composer('layouts.dash', BreadcrumbComposer::class);
        View::composer('layouts.web', NavbarComposer::class);
        View::composer('layouts.web', PopupComposer::class);
    }
}
