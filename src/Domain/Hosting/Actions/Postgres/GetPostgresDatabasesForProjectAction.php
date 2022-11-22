<?php

namespace Domain\Hosting\Actions\Postgres;

use Domain\Hosting\DTO\DatabaseDto;
use Domain\Hosting\K8s\CRD\CloudNativePostgresResource;
use Domain\Hosting\K8s\GetClusterTrait;
use Domain\Hosting\Models\Project;
use RenokiCo\PhpK8s\ResourcesList;

class GetPostgresDatabasesForProjectAction
{
    use GetClusterTrait;

    /*
     * @return array<CloudNativePostgresResource>
     */
    public function execute(Project $project): array
    {
        $cluster = $this->getCluster();

        /** @var ResourcesList $databases */
        $databases = $cluster->cloudNativePostgresResources()->whereNamespace($project->getK8sNamespace())->get();

        return $databases->map(
            fn(CloudNativePostgresResource $resource) => DatabaseDto::fromCloudNativePostgresResource($resource))
            ->all();
    }

}
