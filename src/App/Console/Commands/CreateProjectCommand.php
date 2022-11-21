<?php

namespace App\Console\Commands;

use Domain\Hosting\Actions\CreateProjectAction;
use Domain\Users\Models\User;
use Illuminate\Console\Command;
use Thettler\LaravelConsoleToolkit\Attributes\Argument;
use Thettler\LaravelConsoleToolkit\Attributes\ArtisanCommand;
use Thettler\LaravelConsoleToolkit\Attributes\Option;
use Thettler\LaravelConsoleToolkit\Concerns\UsesConsoleToolkit;

#[ArtisanCommand(name: "project:create")]
class CreateProjectCommand extends Command
{
    use UsesConsoleToolkit;

    #[Argument]
    public string $project_name;

    #[Option]
    public ?string $user_id;

    public function handle(
        CreateProjectAction $createProjectAction
    ){
        if(empty($this->user_id)){
            $this->user_id = User::factory()->create()->id;
        }
        $createProjectAction->execute($this->project_name, $this->user_id);

        $this->info("Project {$this->project_name} created");
    }

}
