<?php

namespace Domain\Hosting\K8s;

use RenokiCo\PhpK8s\KubernetesCluster;

trait GetClusterTrait
{
    protected function getCluster(): KubernetesCluster {
        return KubernetesCluster::fromKubeConfigYamlFile('/home/alex/.kube/config');
    }
}
