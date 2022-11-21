<?php

namespace App\Console\Commands\PostgresDatabase;

use Domain\Hosting\Actions\Postgres\CreatePostgresDatabaseAction;
use Domain\Hosting\Models\Project;
use Domain\Hosting\ValueObjects\Cpu;
use Domain\Hosting\ValueObjects\Memory;
use Domain\Hosting\ValueObjects\Storage;
use Illuminate\Console\Command;
use Thettler\LaravelConsoleToolkit\Attributes\Argument;
use Thettler\LaravelConsoleToolkit\Attributes\ArtisanCommand;
use Thettler\LaravelConsoleToolkit\Attributes\Option;
use Thettler\LaravelConsoleToolkit\Concerns\UsesConsoleToolkit;

#[ArtisanCommand(name: "katara:database:create")]
class CreatePostgresDatabaseCommand extends Command
{
    use UsesConsoleToolkit;

    #[Argument]
    public string $project_name;

    #[Argument]
    public string $database_name;

    #[Option(description: "Memory in Mi")]
    public int $memory;
    #[Option(description: "CPU in millicores")]
    public int $cpu;
    #[Option(description: "Storage in Mi")]
    public int $storage;
    #[Option(description: "Replicas")]
    public int $instances = 1;

    public function handle(
        CreatePostgresDatabaseAction $createPostgresDatabaseAction
    ): void
    {
        $project = Project::where('name', $this->project_name)->firstOrFail();
        $createPostgresDatabaseAction->execute(
            $project,
            $this->database_name,
            Cpu::fromMilliCpus($this->cpu),
            Memory::fromMiBytes($this->memory),
            Storage::fromMiBytes($this->storage),
            1
        );

        $this->info("Database {$this->database_name} created");
    }

}
