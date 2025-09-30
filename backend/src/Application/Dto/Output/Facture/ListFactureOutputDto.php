<?php

declare(strict_types=1);

namespace App\Application\Dto\Output\Facture;

final class ListFactureOutputDto
{
    /** @param FactureOutputDto[] $factures */
    public function __construct(
        public readonly array $factures
    ) {}
}