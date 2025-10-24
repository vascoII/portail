<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class InfosDepannages
{
    /**
     * @param InfosDepannage[] $listeInfosDepannages
     */
    public function __construct(
        public readonly array $listeInfosDepannages
    ) {}
}
