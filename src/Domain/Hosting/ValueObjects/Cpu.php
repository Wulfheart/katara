<?php

namespace Domain\Hosting\ValueObjects;

final class Cpu
{
    private function __construct(
        private int $milliCpus,
    ) {
        if($this->milliCpus <= 0) {
            throw new \InvalidArgumentException('MilliCpus must be positive');
        }
    }
    public static function fromMilliCpus(int $mib): self
    {
        return new self($mib);
    }

    public function toKubernetes(): string
    {
        return "{$this->milliCpus}m";
    }

}
