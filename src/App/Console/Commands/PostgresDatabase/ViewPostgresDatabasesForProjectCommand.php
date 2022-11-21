<?php

namespace App\Console\Commands\PostgresDatabase;

use Domain\Hosting\Actions\Postgres\GetPostgresDatabasesForProjectAction;
use Domain\Hosting\Models\Project;
use Illuminate\Console\Command;
use Thettler\LaravelConsoleToolkit\Attributes\Argument;
use Thettler\LaravelConsoleToolkit\Attributes\ArtisanCommand;
use Thettler\LaravelConsoleToolkit\Concerns\UsesConsoleToolkit;

#[ArtisanCommand(name: "katara:database:view")]
class ViewPostgresDatabasesForProjectCommand extends Command
{
    use UsesConsoleToolkit;

    #[Argument]
    public string $project_name;

    public function handle(
        GetPostgresDatabasesForProjectAction $getPostgresDatabasesForProjectAction
    ): void
    {
        $project = Project::where('name', $this->project_name)->firstOrFail();
        $getPostgresDatabasesForProjectAction->execute($project);
    }

}
