<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class InfosFuites
{
    /**
     * @param InfosFuite[] $listeInfosFuites
     */
    public function __construct(
        public readonly array $listeInfosFuites
    ) {}
}
