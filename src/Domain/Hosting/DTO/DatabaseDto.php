<?php

namespace Domain\Hosting\DTO;

use Domain\Hosting\K8s\CRD\CloudNativePostgresResource;
use Domain\Hosting\ValueObjects\Cpu;
use Domain\Hosting\ValueObjects\Storage;
use Spatie\LaravelData\Data;

class DatabaseDto
{
    public function __construct(
        public string $name,
        public ?string $status,
        public string $namespace,
        public ?int $instances,
        public ?string $cpu,
        public ?string $memory,
        public ?string $storage,
        public ?string $created_at,
    ) {
    }
    public static function fromCloudNativePostgresResource(CloudNativePostgresResource $res): self {
        return new self(
            $res->getName(),
            $res->getPhase(),
            $res->getNamespace(),
            $res->getStatus('instances'),
            $res->getSpec('resources.requests.cpu'),
            $res->getSpec('resources.requests.memory'),
            $res->storageSize(),
            $res->getAttribute('metadata.creationTimestamp'),
        );
    }

}
