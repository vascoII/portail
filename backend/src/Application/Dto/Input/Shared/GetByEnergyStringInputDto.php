<?php

declare(strict_types=1);

namespace App\Application\Dto\Input\Shared;

final class GetByEnergyStringInputDto
{
    public function __construct(
        public readonly string $energy
    ) {}
}
