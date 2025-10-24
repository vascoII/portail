<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class DetailsDepannage
{
    /**
     * @param Depannage[] $listeDepannagesOccupant
     */
    public function __construct(
        public readonly ?InfosDepannage $infosDepannage,
        public readonly array $listeDepannagesOccupant
    ) {}
}
