<?php

namespace App\Providers;

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

            // if ($this->app->environment() !== 'production') {
            //     $this->app->register(IdeHelperServiceProvider::class);
            // }
            // if ($this->app->environment('local', 'testing')) {
            //     $this->app->register(DuskServiceProvider::class);
            // }
        }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
