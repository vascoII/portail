<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Occupant;

final class PostOccupantInputDto
{
    public function __construct(
        public readonly ?string $nom,
        public readonly ?string $ref,
        public readonly ?\DateTimeImmutable $dateArrivee,
        public readonly ?\DateTimeImmutable $dateDepart
    ) {}
}
