<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class Occupant4Chgt
{
  public function __construct(
    public readonly ?int $pkOccupant,
    public readonly ?string $nom,
    public readonly ?string $codeLogeGestio,
    public readonly ?\DateTime $dateArrivee,
    public readonly ?string $email,
    public readonly ?string $telfixe,
    public readonly ?string $telmobile,
    public readonly ?string $numbail,
    public readonly ?string $idImm,
    public readonly ?string $codegestioImm,
    public readonly ?string $adresseImm,
    public readonly ?string $cpImm,
    public readonly ?string $villeImm,
    public readonly ?string $numBat,
    public readonly ?string $adresseBat,
    public readonly ?string $numEsc,
    public readonly ?string $adresseEsc,
    public readonly ?string $numetage,
    public readonly ?string $numordre,
    public readonly ?int $newPkOccupant,
    public readonly ?string $newNom,
    public readonly ?string $newCodeLogeGestio,
    public readonly ?\DateTime $newDateArrivee,
    public readonly ?string $newEmail,
    public readonly ?string $newTelfixe,
    public readonly ?string $newTelmobile,
    public readonly ?string $newNumbail,
    public readonly ?bool $isNew,
    public readonly ?string $erreur
  ) {}
}
