<?php

namespace App\Try\Commands;

use Domain\Hosting\Actions\CreatePostgresDatabaseAction;
use Illuminate\Console\Command;
use RenokiCo\PhpK8s\K8s;
use RenokiCo\PhpK8s\KubernetesCluster;

class TryCommand extends Command
{
    protected $signature = 'try';

    protected $description = '';

    public function handle(CreatePostgresDatabaseAction $createPostgresDatabaseAction): void
    {
        $createPostgresDatabaseAction->execute("test");

    }
}
