<?php

declare(strict_types=1);

namespace App\Application\Factory\Facture;

use App\Application\Dto\Output\Facture\GetFacturesOutputDto;
use App\Domain\Entity\Facture;

class FactureOutputFactory
{
    /**
     * @param Facture[] $factures
     */
    public function create(array $factures): GetFacturesOutputDto
    {
        return new GetFacturesOutputDto($factures);
    }
}
