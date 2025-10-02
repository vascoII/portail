<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Logement;

use App\Domain\Entity\InfosAppareilCET;
use App\Domain\Entity\InfosAppareilRepart;
use App\Domain\Entity\InfosAppareilEAU;
use App\Domain\Entity\InfosAppareilElect;
use App\Domain\Entity\InfosAppareilGaz;

final class GetInfosAppareilsByLogementOutputDto
{
  /** @param InfosAppareilCET[] $infosAppareilCET */
  /** @param InfosAppareilRepart[] $infosAppareilRepart */
  /** @param InfosAppareilEAU[] $infosAppareilEAU */
  /** @param InfosAppareilElect[] $infosAppareilElect */
  /** @param InfosAppareilGaz[] $infosAppareilGaz */
  public function __construct(
    public readonly array $infosAppareilCET,
    public readonly array $infosAppareilRepart,
    public readonly array $infosAppareilEAU,
    public readonly array $infosAppareilElect,
    public readonly array $infosAppareilGaz
  ) {}
}
