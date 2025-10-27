<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Transformer;

use App\Application\Dto\Output\Parc\GetParcOutputDto;
use App\Application\Service\Transformer\ParcTransformerInterface;
use App\Application\Factory\Parc\GetParcOutputFactory;
use App\Application\Factory\Parc\GetParcEntityFactory;

final class ParcTransformer implements ParcTransformerInterface
{
    public function __construct(
        private readonly GetParcEntityFactory $entityFactory,
        private readonly GetParcOutputFactory $outputFactory
    ) {}

    public function transformGetParc(object $dataSourceResult): GetParcOutputDto
    {
        $entity = $this->entityFactory->createTableauDeBordClientFromRaw($dataSourceResult);

        return $this->outputFactory->createGetOperator($entity);
    }
}
