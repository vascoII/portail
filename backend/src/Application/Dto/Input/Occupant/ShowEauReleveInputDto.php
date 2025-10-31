<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Occupant;

final class ShowEauReleveInputDto
{
    public function __construct(
        public readonly string $pkOccupant
    ) {}
}
