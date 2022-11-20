<?php

namespace Domain\Hosting\K8s\CRD;

use RenokiCo\PhpK8s\Contracts\InteractsWithK8sCluster;
use RenokiCo\PhpK8s\Kinds\K8sResource;

class CloudNativePostgresResource extends K8sResource implements InteractsWithK8sCluster
{
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
}
