<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class TableauDeBordImmeuble
{
  public function __construct(
    public readonly ?Immeuble $immeuble,
    public readonly ?int $nbLogements,
    public readonly ?int $nbAppareils,
    public readonly ?int $nbDepannages,
    public readonly ?int $nbDepannagesTotal,
    public readonly ?int $degresDepannages,
    public readonly ?int $nbDysfonctionnements,
    public readonly ?int $degresDysfonctionnements,
    public readonly ?bool $hasTelereleve,
    public readonly ?int $nbCompteursEc,
    public readonly ?int $nbCompteursEf,
    public readonly ?int $nbCompteursRepart,
    public readonly ?int $nbCompteursCet,
    public readonly ?int $nbCompteursCapteur,
    public readonly ?int $nbCompteursElect,
    public readonly ?int $nbCompteursGaz,
    public readonly ?int $nbCompteursTelereveleTotal,
    public readonly ?int $nbCompteursTelereveleOk,
    public readonly ?bool $hasTransfertFichiers,
    public readonly ?ImmeubleEAU $immeubleEc, // Will be updated when immeubleEAU is defined
    public readonly ?ImmeubleEAU $immeubleEf, // Will be updated when immeubleEAU is defined
    public readonly ?ImmeubleRepart $immeubleRepart, // Will be updated when immeubleRepart is defined
    public readonly ?ImmeubleCET $immeubleCet, // Will be updated when immeubleCET is defined
    public readonly ?ImmeubleCapteur $immeubleCapteur, // Will be updated when immeubleCapteur is defined
    public readonly ?ImmeubleElect $immeubleElect, // Will be updated when immeubleElect is defined
    public readonly ?ImmeubleGaz $immeubleGaz, // Will be updated when immeubleGaz is defined
    public readonly ?Serie $serieConsosEau,
    public readonly ?Serie $serieConsosCompteurGeneral
  ) {}
}
