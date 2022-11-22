<?php

namespace Domain\Hosting\Actions\Postgres;

use Domain\Hosting\K8s\GetClusterTrait;
use Domain\Hosting\Models\Project;

class DeletePostgresDatabaseAction
{
    use GetClusterTrait;

    public function execute(Project $project, string $database_name): void
    {
        $cluster = $this->getCluster();
        $cluster->cloudNativePostgresResources()
            ->whereNamespace($project->getK8sNamespace())
            ->whereName($database_name)
            ->delete();
    }

}
