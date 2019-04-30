<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('components.alert', 'alert_component');
        Blade::component('components.breadcrumb', 'breadcrumb_component');
        Blade::component('components.search', 'search_component');
        Blade::component('components.table', 'table_component');
        Blade::component('components.paginate', 'paginate_component');
        Blade::component('components.page', 'page_component');
        Blade::component('components.form', 'form_component');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // User Repository
        $this->app->bind('App\Repositories\Contracts\UserRepositoryInterface',
        'App\Repositories\Eloquent\UserRepository');

        // Permission Repository
        $this->app->bind('App\Repositories\Contracts\PermissionRepositoryInterface',
        'App\Repositories\Eloquent\PermissionRepository');
    }
}
