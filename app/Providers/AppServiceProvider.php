<?php

namespace App\Providers;

use App\Filament\Resources\CategoryResource;
use Encore\Admin\Config\Config;
use Filament\Facades\Filament;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\UserMenuItem;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use L5Swagger\L5SwaggerServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->register(L5SwaggerServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $table = config('admin.extensions.config.table', 'admin_config');
        if (Schema::hasTable($table)) {
            Config::load();
        }
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        Validator::extend('phone_number', function ($attribute, $value) {
            return str_starts_with($value, '+374') && preg_match('/^(?:\+374)(?:\d{8})$/', $value);
        });
    }
}
