<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Benchmark;
use RenokiCo\PhpK8s\K8s;
use RenokiCo\PhpK8s\Kinds\K8sPod;
use RenokiCo\PhpK8s\KubernetesCluster;

class KubeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'k';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function handle()
    {
        $cluster = KubernetesCluster::fromKubeConfigYamlFile('/home/alex/.kube/config');

        Benchmark::dd(function() use ($cluster) {
            $pods = $cluster->getAllPods();

            /** @var K8sPod $pod */
            $pod = $pods[0];

            $l = $pod->logs(['sinceTime' => urlencode(now()->subSeconds(10)->toRfc3339String())]);
            //$this->line($l);
        });
    }
}
