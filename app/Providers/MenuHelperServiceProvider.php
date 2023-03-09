<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MenuHelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path("Helpers/menuHelpers.php");
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
