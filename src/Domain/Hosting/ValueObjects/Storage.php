<?php

namespace Domain\Hosting\ValueObjects;

class Storage
{
    private function __construct(
        private int $miBytes,
    ) {
        if($this->miBytes <= 0) {
            throw new \InvalidArgumentException('MiBytes must be positive');
        }
    }
    public static function fromMiBytes(int $mib): self
    {
        return new self($mib);
    }

    public function toKubernetes(): string
    {
        return "{$this->miBytes}Mi";
    }
}
