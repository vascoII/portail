<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class TableauDeBordLogement
{
  public function __construct(
    public readonly ?Immeuble $immeuble,
    public readonly ?Logement $logement,
    public readonly ?Occupant $occupant,
    public readonly ?int $nbAppareils,
    public readonly ?int $nbCompteursEc,
    public readonly ?int $nbCompteursEf,
    public readonly ?int $nbCompteursRepart,
    public readonly ?int $nbCompteursCet,
    public readonly ?int $nbCompteursCapteur,
    public readonly ?int $nbCompteursElect,
    public readonly ?int $nbCompteursGaz,
    public readonly ?int $nbDepannages,
    public readonly ?int $nbDepannagesTotal,
    public readonly ?int $nbDysfonctionnements,
    public readonly ?int $nbTicketsInter,
    public readonly ?bool $ticketsInterEnabled,
    public readonly ?object $logementEc, // Will be updated when logementEAU is defined
    public readonly ?object $logementEf, // Will be updated when logementEAU is defined
    public readonly ?object $logementRepart, // Will be updated when logementRepart is defined
    public readonly ?object $logementCet, // Will be updated when logementCET is defined
    public readonly ?object $logementCapteur, // Will be updated when logementCapteur is defined
    public readonly ?object $logementElect, // Will be updated when logementElect is defined
    public readonly ?object $logementGaz // Will be updated when logementGaz is defined
  ) {}
}
