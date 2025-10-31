<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\Facture\ListFacturesOutputDto;

interface FactureTransformerInterface
{
    /**
     * Transform raw response to IndexOutputDto.
     */
    public function transformListFactures(object $dataSourceResult): ListFacturesOutputDto;
}
