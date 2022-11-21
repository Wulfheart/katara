<?php

namespace Domain\Hosting\ValueObjects;

final class Memory
{
    private function __construct(
        private int $miBytes,
    ) {
        if($this->miBytes <= 0) {
            throw new \InvalidArgumentException('Memory must be positive');
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
