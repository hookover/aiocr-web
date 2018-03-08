<?php

namespace App\Providers;

use App\Hashers\ShaHasher;
use Illuminate\Support\ServiceProvider;

class ShaHashServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('hash', function() { return new ShaHasher(); });
    }
}
