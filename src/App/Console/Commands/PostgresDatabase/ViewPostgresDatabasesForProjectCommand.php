<?php

namespace App\Console\Commands\PostgresDatabase;

use Domain\Hosting\Actions\Postgres\GetPostgresDatabasesForProjectAction;
use Domain\Hosting\DTO\DatabaseDto;
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
    ): int
    {
        $project = Project::where('name', $this->project_name)->firstOrFail();
        $projects = $getPostgresDatabasesForProjectAction->execute($project);

        $headers = ['Name', 'Instances', 'Storage', 'CPU', 'Memory', 'Status'];
        $data = collect($projects)->map(function (DatabaseDto $db) {
            return [
                'name' => $db->name,
                'instances' => $db->instances,
                'storage' => $db->storage,
                'cpu' => $db->cpu,
                'memory' => $db->memory,
                'status' => $db->status,
            ];
        });
        $this->table($headers, $data);

        return Command::SUCCESS;

    }

}
