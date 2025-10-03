<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class InfosAppareilsGaz
{
    /**
    * @param InfosAppareilGaz[] $listeInfosAppareils
    */
    public function __construct(
        public ?array $listeInfosAppareils = null // InfosAppareilGaz[]
    ) {}
}