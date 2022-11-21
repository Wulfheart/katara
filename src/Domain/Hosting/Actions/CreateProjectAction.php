<?php

namespace Domain\Hosting\Actions;

use Domain\Hosting\K8s\GetClusterTrait;
use Domain\Hosting\Models\Project;

class CreateProjectAction
{
    use GetClusterTrait;

    public function execute(string $name, string $userId): Project
    {
        $project = Project::create([
            'name' => $name,
            'user_id' => $userId,
        ]);

        $this->getCluster()->namespace()->setName($project->name)->setLabels([
            'katara-project' => $project->name,
            'katara-project-id' => $project->id
        ])->create();

        return $project;
    }
}
