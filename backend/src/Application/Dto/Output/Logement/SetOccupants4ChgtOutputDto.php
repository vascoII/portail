<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Logement;

final class Occupant4ChgtDto
{
  public function __construct(
    public readonly int $pkOccupant,
    public readonly string $nom,
    public readonly string $codeLogeGestio,
    public readonly string $dateArrivee,
    public readonly string $email,
    public readonly string $telFixe,
    public readonly string $telMobile,
    public readonly string $numBail,
    public readonly string $idImm,
    public readonly string $codeGestioImm,
    public readonly string $adresseImm,
    public readonly string $cpImm,
    public readonly string $villeImm,
    public readonly string $numBat,
    public readonly string $adresseBat,
    public readonly string $numEsc,
    public readonly string $adresseEsc,
    public readonly string $numEtage,
    public readonly string $numOrdre,
    public readonly int $newPkOccupant,
    public readonly string $newNom,
    public readonly string $newCodeLogeGestio,
    public readonly string $newDateArrivee,
    public readonly string $newEmail,
    public readonly string $newTelFixe,
    public readonly string $newTelMobile,
    public readonly string $newNumBail,
    public readonly bool $isNew,
    public readonly string $error
  ) {}
}

final class SetOccupants4ChgtOutputDto
{
  public function __construct(
    public readonly array $occupants
  ) {}
}
