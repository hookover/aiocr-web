<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapUserAndDeveloperRoutes();

        $this->mapUserRoutes();

        $this->mapDeveloperRoutes();

        $this->mapAdminRoutes();

        $this->mapAllRoutes();
    }

    protected function mapAllRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/all.php'));
    }
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->domain(env('USER_DOMAIN'))
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    protected function mapUserAndDeveloperRoutes()
    {
        Route::middleware('web')
            ->domain(env('USER_DOMAIN'))
            ->namespace($this->namespace)
            ->group(base_path('routes/developer_user.php'));
    }

    protected function mapUserRoutes()
    {
        Route::middleware('web')
            ->domain(env('USER_DOMAIN'))
            ->namespace($this->namespace)
            ->group(base_path('routes/user.php'));
    }

    protected function mapDeveloperRoutes()
    {
        Route::middleware('web')
            ->domain(env('USER_DOMAIN'))
            ->namespace($this->namespace)
            ->group(base_path('routes/developer.php'));
    }

    protected function mapAdminRoutes()
    {
        Route::middleware('web')
            ->domain(env('ADMIN_DOMAIN'))
            ->namespace($this->namespace)
            ->group(base_path('routes/admin.php'));
    }




    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
