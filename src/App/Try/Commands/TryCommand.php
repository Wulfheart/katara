<?php

namespace App\Try\Commands;

use Illuminate\Console\Command;
use RenokiCo\PhpK8s\K8s;
use RenokiCo\PhpK8s\KubernetesCluster;

class TryCommand extends Command
{
    protected $signature = 'try';

    protected $description = '';

    public function handle(): void
    {

        $container = K8s::container()
            ->setName('mysql')
            ->setImage('mysql', '5.7')
            ->setPorts([
                ['name' => 'mysql', 'protocol' => 'TCP', 'containerPort' => 3306],
            ]);

        $pod = K8s::pod()
            ->setName('mysql')
            ->setLabels(['tier' => 'backend']) // needs deployment-name: mysql so that ->getPods() can work
            ->setContainers([$container]);
        $cluster = KubernetesCluster::fromKubeConfigYamlFile('');

        $dep = $cluster
            ->deployment()
            ->setName('mysql')
            ->setSelectors(['matchLabels' => ['tier' => 'backend']])
            ->setReplicas(1)
            ->setTemplate($pod)
            ->create();

        $dep->scaler()->
    }
}
