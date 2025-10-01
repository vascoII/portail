<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Immeuble;

final class InfosLogement
{
  public function __construct(
    public readonly object $immeuble,
    public readonly object $logement,
    public readonly object $occupant,
    public readonly int $nbAppareils,
    public readonly int $nbCompteursEc,
    public readonly int $nbCompteursEf,
    public readonly int $nbCompteursRepart,
    public readonly int $nbCompteursCet,
    public readonly int $nbCompteursCapteur,
    public readonly int $nbCompteursElect,
    public readonly int $nbCompteursGaz,
    public readonly int $nbFuites,
    public readonly int $nbDepannages,
    public readonly int $nbDysfonctionnements,
    public readonly int $nbAnomalies,
    public readonly int $nbTicketsInter,
    public readonly bool $ticketsInterEnabled,
    public readonly array $listeAppareils
  ) {}
}
