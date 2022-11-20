<?php

namespace App\Providers;

use Domain\Hosting\K8s\CRD\CloudNativePostgresResource;
use Domain\Hosting\K8s\KubernetesCluster;
use Illuminate\Support\ServiceProvider;

class KubernetesProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        CloudNativePostgresResource::register('cloudNativePostgresResources');

        $this->app->bind(KubernetesCluster::class, function () {
            return \RenokiCo\PhpK8s\KubernetesCluster::fromKubeConfigYamlFile('/home/alex/.kube/config');
        });
    }
}
