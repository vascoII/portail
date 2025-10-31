<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Shared;

use App\Domain\Entity\DetailsDepannage;

final class GetDetailsDepannageOutputDto
{
    public function __construct(
        public readonly DetailsDepannage $detailsDepannage
    ) {}
}
