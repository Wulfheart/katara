<?php

namespace App\Try\Commands;

use Domain\Hosting\Actions\Postgres\CreatePostgresDatabaseAction;
use Domain\Hosting\ValueObjects\Cpu;
use Domain\Hosting\ValueObjects\Memory;
use Domain\Hosting\ValueObjects\Storage;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class TryCommand extends Command
{
    protected $signature = 'try';

    protected $description = '';

    public function handle(CreatePostgresDatabaseAction $createPostgresDatabaseAction): void
    {
        $createPostgresDatabaseAction->execute(
            Str::uuid()->toString(),
            "test",
            "default",
            Cpu::fromMilliCpus(1000),
            Memory::fromMiBytes(250),
            Storage::fromMiBytes(1000),
            1
        );

    }
}
