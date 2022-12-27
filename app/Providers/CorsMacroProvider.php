<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CorsMacroProvider extends ServiceProvider
{
    public function boot()
    {
        \Response::macro('cors', function ($value) {
            return $this->header('Access-Control-Allow-Origin', $value);
        });
    }
}
