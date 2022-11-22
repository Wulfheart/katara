<?php

namespace Domain\Hosting\DTO\Normalizers;

use Domain\Hosting\K8s\CRD\CloudNativePostgresResource;
use Spatie\LaravelData\Normalizers\Normalizer;

class CloudNativePostgresResourceNormalizer implements Normalizer
{

    public function normalize(mixed $value): ?array
    {
        if(!is_a($value, CloudNativePostgresResource::class)) {
            return null;
        }
        /** @var CloudNativePostgresResource $value */
        //return [
        //    'name' => $value->getName(),
        //    'namespace' => $value->getNamespace(),
        //    'status' => $value->,
        //    'spec' => $value->getSpec(),
        //];
    }
}
