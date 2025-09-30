<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Front;

final class PersonalDatasOutputDto
{
  /** @param ListSousTraitantOutputDto $listSousTraitants */
  public function __construct(
      public readonly ListSousTraitantOutputDto $listSousTraitants
  ) {}
}
