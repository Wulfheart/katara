<?php

namespace Domain\Hosting\Actions;

use Domain\Hosting\K8s\CRD\CloudNativePostgresResource;
use Domain\Hosting\K8s\GetClusterTrait;
use Domain\Hosting\ValueObjects\Cpu;
use Domain\Hosting\ValueObjects\Memory;
use Domain\Hosting\ValueObjects\Storage;
use RenokiCo\PhpK8s\K8s;
use RenokiCo\PhpK8s\KubernetesCluster;

class CreatePostgresDatabaseAction {
    use GetClusterTrait;

    public function execute(string $project_id, Cpu $cpu, Memory $memory, Storage $storage, int $instances): void {
        // TODO: Check if cpng is installed

        $cluster = $this->getCluster();

        $cloudNativePostgresResource = new CloudNativePostgresResource($cluster, [
            'metadata' => [
                'name' => $project_id . "-db4",
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
