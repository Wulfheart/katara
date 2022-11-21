<?php

namespace Domain\Hosting\Actions\Postgres;

use Domain\Hosting\K8s\CRD\CloudNativePostgresResource;
use Domain\Hosting\K8s\GetClusterTrait;
use Domain\Hosting\Models\Project;
use Domain\Hosting\ValueObjects\Cpu;
use Domain\Hosting\ValueObjects\Memory;
use Domain\Hosting\ValueObjects\Storage;

class CreatePostgresDatabaseAction
{
    use GetClusterTrait;

    public function execute(
        Project $project,
        string  $name,
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
                'namespace' => $project->getK8sNamespace(),
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
                    'limits' => [
                        'cpu' => $cpu->toKubernetes(),
                        'memory' => $memory->toKubernetes(),
                    ],
                ],
            ],
        ]);
        $cloudNativePostgresResource->setLabels($project->getK8sLabels());
        $cloudNativePostgresResource->create();

    }
}
