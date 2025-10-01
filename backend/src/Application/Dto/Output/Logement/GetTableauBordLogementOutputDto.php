<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Logement;

final class GetTableauBordLogementOutputDto
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
    public readonly int $nbDepannages,
    public readonly int $nbDepannagesTotal,
    public readonly int $nbDysfonctionnements,
    public readonly int $nbTicketsInter,
    public readonly bool $ticketsInterEnabled,
    public readonly object $logementEc,
    public readonly object $logementEf,
    public readonly object $logementRepart,
    public readonly object $logementCet,
    public readonly object $logementCapteur,
    public readonly object $logementElect,
    public readonly object $logementGaz
  ) {}
}
