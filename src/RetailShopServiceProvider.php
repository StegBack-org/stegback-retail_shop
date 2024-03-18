<?php

namespace Stegback\RetailShop;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class RetailShopServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (File::exists(__DIR__ . '\Helpers\CommonHelper.php')) {
            require __DIR__ . '\Helpers\CommonHelper.php';
        }
        $this->loadRoutesFrom(__DIR__ . '/routes/shop_routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/database');
        $this->loadViewsFrom(resource_path('views'), 'laravel');
        $this->loadViewsFrom(__DIR__ . '/views/RetailShop', 'RetailShop');

        $this->registerRoutes();

        $this->publishes([
            __DIR__ . '/views' => resource_path('/views'),
        ], 'stegback-retail-shop-views');

        $this->publishes([
            __DIR__ . '/config/retailshop.php' => config_path('retailshop.php'),
        ], 'retailshop-config');
    }

    public function register()
    {
        //
    }

    private function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/routes/shop_routes.php');
        });
    }

    /**
     * Get the Blogg route group configuration array.
     *
     * @return array
     */
    private function routeConfiguration()
    {
        return [
            // 'namespace'  => "Stegback\RetailShop\Http",
            'middleware' => 'web',
        ];
    }
}
