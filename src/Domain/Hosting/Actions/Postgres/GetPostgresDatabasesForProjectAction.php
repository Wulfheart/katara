<?php

namespace Domain\Hosting\Actions\Postgres;

use Domain\Hosting\K8s\GetClusterTrait;

class GetPostgresDatabasesForProjectAction
{
    use GetClusterTrait;

    /*
     * @return
     */
    public function execute(string $project_id): array
    {
        $cluster = $this->getCluster();

        $databases = $cluster->cloudNativePostgresResources()->whereNamespace($project_id)->get();

        dd($databases);

    }

}
