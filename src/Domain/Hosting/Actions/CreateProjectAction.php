<?php

namespace Domain\Hosting\Actions;

use Domain\Hosting\Models\Project;

class CreateProjectAction
{
    public function execute(string $name, string $userId): Project
    {
        return Project::create([
            'name' => $name,
            'user_id' => $userId,
        ]);
    }
}
