<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class InfosAppareilsGaz
{
    public function __construct(
        public ?array $listeInfosAppareils = null // InfosAppareilGaz[]
    ) {}
}