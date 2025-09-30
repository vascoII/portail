<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Facture;

use DateTimeImmutable;

final class FactureOutputDto
{
    public function __construct(
        public readonly int $pkFacture,
        public readonly string $numFacture,
        public readonly DateTimeImmutable $dateEdition,
        public readonly DateTimeImmutable $dateDebut,
        public readonly DateTimeImmutable $dateFin,
        public readonly float $montantTotalHT,
        public readonly float $montantTotalTTC,
        public readonly float $montantTotalAPayer,
        public readonly string $idImm,
        public readonly string $codeGestio,
        public readonly string $cp,
        public readonly string $adresse,
        public readonly string $ville
    ) {}
}
