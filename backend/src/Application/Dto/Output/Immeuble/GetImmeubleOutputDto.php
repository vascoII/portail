<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Immeuble;

final class GetImmeubleOutputDto
{
  
  public function __construct(
      public readonly ?int $pkImmeuble,
      public readonly ?string $nom,
      public readonly ?string $numero,
      public readonly ?string $ref,
      public readonly ?string $adresse1,
      public readonly ?string $adresse2,
      public readonly ?string $adresse3,
      public readonly ?string $cp,
      public readonly ?string $ville,
      public readonly ?bool $hasTelereleve,
      public readonly ?int $fkClientTop,
      public readonly ?bool $actif,
      public readonly ?\DateTimeImmutable $dateActivationClient,
      public readonly ?\DateTimeImmutable $dateActivationOccupant,
      public readonly ?bool $hasNoteOccupant,
      public readonly ?bool $hasDecompteOccupant,
      public readonly ?bool $hasFactures,
      public readonly ?bool $hasChantiers
  ) {

  }
}
