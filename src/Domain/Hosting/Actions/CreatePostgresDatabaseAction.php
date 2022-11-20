<?php

namespace Domain\Hosting\Actions;

use Domain\Hosting\K8s\CRD\CloudNativePostgresResource;
use Domain\Hosting\K8s\GetClusterTrait;
use RenokiCo\PhpK8s\K8s;
use RenokiCo\PhpK8s\KubernetesCluster;

class CreatePostgresDatabaseAction {
    use GetClusterTrait;

    public function execute(string $project_id): void {
        // TODO: Check if cpng is installed

        $cluster = $this->getCluster();

        $cpngr = new CloudNativePostgresResource($cluster, [
            'metadata' => [
                'name' => $project_id . "-db4",
                'namespace' => 'pro',
            ],
            'spec' => [
                'instances' => 1,
                //'imageName' => "ghcr.io/cloudnative-pg/cloudnative-pg:1.17.2",
                'primaryUpdateStrategy' => 'unsupervised',
                'storage' => [
                    'size' => '4Gi',
                ],
            ],
        ]);
        $cpngr->createOrUpdate();

    }
}
