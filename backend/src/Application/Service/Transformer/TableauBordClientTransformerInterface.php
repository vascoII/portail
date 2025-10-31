<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\TableauBordClient\GetTableauBordClientOutputDto;

interface TableauBordClientTransformerInterface
{
    /**
     * Transform raw response to GetTableauBordClientOutputDto.
     */
    public function transformGetTableauBordClient(object $dataSourceResult): GetTableauBordClientOutputDto;
}
