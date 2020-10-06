<?php
namespace leonardo_organization;

use Illuminate\Support\ServiceProvider;

class organizationProvider extends ServiceProvider
{

    public function boot()
    {
        // $this->loadRoutesFrom(__DIR__ . '/routesDocumentacion.php');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->publishes([__DIR__ . '/database/migrations' => base_path('database/migrations')]);
        // $this->loadViewsFrom(__DIR__ . '/resources/views/organization', 'documentacion');
        // $this->publishes([__DIR__ . '/resources/views/organization' => resource_path('views/vendor/documentacion'),]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

}
