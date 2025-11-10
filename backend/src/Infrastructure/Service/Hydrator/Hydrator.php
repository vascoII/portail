<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Hydrator;

class Hydrator
{
    public function __construct(
        protected readonly string $superLoginID,
        protected readonly string $superPassword,
        protected readonly string $adminSessionId
    ) {}

    public function toParamsFiltresString(array $params): string
    {
        $keys = [
            'PKIMMEUBLE',
            'PKLOGEMENT',
            'PKOCCUPANT',
            'PKINTERVENTION',
            'WORKORDERNUMBER',
            'DATE',
            'PKUSER',
            'DATE1',
            'DATE2',
            'PKFACTURE',
            'PKRELEVE',
            'CALLBACKURL',
            'TYPEERC',
        ];

        $filteredKeys = array_filter($keys, fn ($key) => isset($params[$key]) && ('' !== $params[$key] || '0' === $params[$key]));
        $pairs = array_map(fn ($key) => "{$key}={$params[$key]}", $filteredKeys);

        return implode('|', $pairs);
    }
}
