<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Facades\SessionFacade;

class FacadeServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('sessionfacade',function(){
            return new SessionFacade();
        });
    }
}
