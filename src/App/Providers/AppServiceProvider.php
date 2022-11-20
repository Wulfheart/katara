<?php

namespace App\Providers;

use Domain\Hosting\K8s\CRD\CloudNativePostgresResource;
use Illuminate\Database\Eloquent\Model;
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
        \Illuminate\Database\Eloquent\Factories\Factory::guessFactoryNamesUsing(
            fn(string $modelName) => 'Database\\Factories\\' . class_basename($modelName) . 'Factory'
        );
        Model::shouldBeStrict();
        Model::unguard();

        //CloudNativePostgresResource::register();
    }
}
