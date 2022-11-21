<?php

namespace Domain\Hosting\Actions\Postgres;

use Domain\Hosting\K8s\GetClusterTrait;
use Domain\Hosting\Models\Project;

class GetPostgresDatabasesForProjectAction
{
    use GetClusterTrait;

    /*
     * @return
     */
    public function execute(Project $project): array
    {
        $cluster = $this->getCluster();

        $databases = $cluster->cloudNativePostgresResources()->whereNamespace($project->getK8sNamespace())->get();

        dd($databases);

    }

}
