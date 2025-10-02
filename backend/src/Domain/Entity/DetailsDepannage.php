<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class DetailsDepannage
{
  /**
   * @param Depannage[] $listeDepannagesOccupant
   */
  public function __construct(
    public readonly ?InfosDepannage $infosDepannage, // Will be updated when infosDepannage is defined
    public readonly array $listeDepannagesOccupant
  ) {}
}
