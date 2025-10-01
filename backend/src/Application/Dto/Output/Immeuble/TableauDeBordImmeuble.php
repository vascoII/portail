<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Immeuble;

final class TableauDeBordImmeuble
{
  public function __construct(
    public readonly object $immeuble,
    public readonly int $nbLogements,
    public readonly int $nbAppareils,
    public readonly int $nbDepannages,
    public readonly int $nbDepannagesTotal,
    public readonly int $degresDepannages,
    public readonly int $nbDysfonctionnements,
    public readonly int $degresDysfonctionnements,
    public readonly bool $hasTelereleve,
    public readonly int $nbCompteursEc,
    public readonly int $nbCompteursEf,
    public readonly int $nbCompteursRepart,
    public readonly int $nbCompteursCet,
    public readonly int $nbCompteursCapteur,
    public readonly int $nbCompteursElect,
    public readonly int $nbCompteursGaz,
    public readonly int $nbCompteursTelereveleTotal,
    public readonly int $nbCompteursTelereveleOk,
    public readonly bool $hasTransfertFichiers,
    public readonly object $immeubleEc,
    public readonly object $immeubleEf,
    public readonly object $immeubleRepart,
    public readonly object $immeubleCet,
    public readonly object $immeubleCapteur,
    public readonly object $immeubleElect,
    public readonly object $immeubleGaz,
    public readonly object $serieConsosEau,
    public readonly object $serieConsosCompteurGeneral
  ) {}
}
