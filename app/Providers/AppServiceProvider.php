<?php

namespace App\Providers;

use App\Http\Controllers\OPCClientController;
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
        //
        $this->app->bind(OPCClientController::class, function ($app) {
            return OPCClientController::initialize(
                OPCClientController::$MachineIP,OPCClientController::$MachinePort
            );
        });
    }
}
