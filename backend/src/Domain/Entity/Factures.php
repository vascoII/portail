<?php

declare(strict_types=1);

namespace App\Domain\Entity;

final class Factures
{
    /**
     * @param Facture[] $listeFactures
     */
    public function __construct(
        public readonly array $listeFactures
    ) {}
}
