<?php

namespace Domain\Hosting\Actions\Postgres;

use Domain\Hosting\K8s\CRD\CloudNativePostgresResource;
use Domain\Hosting\K8s\GetClusterTrait;
use Domain\Hosting\ValueObjects\Cpu;
use Domain\Hosting\ValueObjects\Memory;
use Domain\Hosting\ValueObjects\Storage;

class CreatePostgresDatabaseAction
{
    use GetClusterTrait;

    public function execute(
        string  $project_id,
        string  $name,
        string  $namespace,
        Cpu     $cpu,
        Memory  $memory,
        Storage $storage,
        int     $instances
    ): void
    {
        // TODO: Check if cpng is installed

        $cluster = $this->getCluster();

        $cloudNativePostgresResource = new CloudNativePostgresResource($cluster, [
            'metadata' => [
                'name' => $name,
                'namespace' => $namespace,
            ],
            'spec' => [
                'instances' => $instances,
                'primaryUpdateStrategy' => 'unsupervised',
                'storage' => [
                    'size' => $storage->toKubernetes(),
                ],
                'resources' => [
                    'requests' => [
                        'cpu' => $cpu->toKubernetes(),
                        'memory' => $memory->toKubernetes(),
                    ],
                    'limit' => [
                        'cpu' => $cpu->toKubernetes(),
                        'memory' => $memory->toKubernetes(),
                    ],
                ],
            ],
        ]);
        $cloudNativePostgresResource->create();

    }
}