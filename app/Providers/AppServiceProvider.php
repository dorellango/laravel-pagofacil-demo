<?php

namespace App\Providers;

use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Support\ServiceProvider;

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
        view()->composer('*', function ($view) {
            $view->with(
                'cartCount',
                auth()->check()
                    ? CartFacade::session(auth()->id())->getContent()->count()
                    : CartFacade::getContent()->count()
            );
        });
    }
}
