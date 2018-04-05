<?php

namespace App\Providers;

use App\Grids\RolesGrid;
use App\Grids\RolesGridInterface;
use App\Grids\UsersGrid;
use App\Grids\UsersGridInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UsersGridInterface::class, UsersGrid::class);
        $this->app->bind(RolesGridInterface::class, RolesGrid::class);
    }
}
