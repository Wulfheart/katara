<?php

namespace Domain\Hosting\K8s\CRD;

use RenokiCo\PhpK8s\Contracts\InteractsWithK8sCluster;
use RenokiCo\PhpK8s\Kinds\K8sResource;
use RenokiCo\PhpK8s\Traits\Resource\HasAttributes;
use RenokiCo\PhpK8s\Traits\Resource\HasPods;
use RenokiCo\PhpK8s\Traits\Resource\HasSpec;
use RenokiCo\PhpK8s\Traits\Resource\HasStatus;
use RenokiCo\PhpK8s\Traits\Resource\HasStatusPhase;

class CloudNativePostgresResource extends K8sResource implements InteractsWithK8sCluster
{
    use HasStatus, HasPods, HasStatusPhase, HasSpec;

    /**
     * The resource Kind parameter.
     *
     * @var null|string
     */
    public static $kind = 'Cluster';

    /**
     * The default version for the resource.
     *
     * @var string
     */
    public static $defaultVersion = 'postgresql.cnpg.io/v1';

    /**
     * Wether the resource has a namespace.
     *
     * @var bool
     */
    protected static $namespaceable = true;

    public function storageSize(): string {
        return $this->getSpec('storage.size');
    }
}
