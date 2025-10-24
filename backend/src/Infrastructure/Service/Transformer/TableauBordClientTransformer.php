<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Transformer;

use App\Application\Dto\Output\TableauBordClient\GetTableauBordClientOutputDto;
use App\Application\Factory\TableauBordClient\TableauBordClientEntityFactory;
use App\Application\Factory\TableauBordClient\TableauBordClientOutputFactory;
use App\Application\Service\Transformer\TableauBordClientTransformerInterface;

final class TableauBordClientTransformer implements TableauBordClientTransformerInterface
{
    public function __construct(
        private readonly TableauBordClientEntityFactory $entityFactory,
        private readonly TableauBordClientOutputFactory $outputFactory
    ) {}

    /**
     * Transform raw response to GetTableauBordClientOutputDto.
     */
    public function transformGetTableauBordClient(object $dataSourceResult): GetTableauBordClientOutputDto
    {
        $result = $dataSourceResult->GetTableauBordClientResult;

        return new GetTableauBordClientOutputDto($result);
    }
}
