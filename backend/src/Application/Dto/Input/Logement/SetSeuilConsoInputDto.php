<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Logement;

final class SetSeuilConsoInputDto
{
    public function __construct(
        public readonly int $seuilConsoEf,
        public readonly int $seuilConsoEc,
        public readonly int $seuilConsoActif,
        public readonly int $seuilConsoEmail
    ) {}
}
