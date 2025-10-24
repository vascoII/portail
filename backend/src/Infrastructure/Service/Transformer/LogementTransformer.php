<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Transformer;

use App\Application\Dto\Output\Logement\ListLogementsOuputDto;
use App\Application\Dto\Output\Logement\LogementOutputDto;
use App\Application\Factory\Logement\LogementEntityFactory;
use App\Application\Factory\Logement\LogementOutputFactory;
use App\Application\Service\Transformer\LogementTransformerInterface;

final class LogementTransformer implements LogementTransformerInterface
{
    public function __construct(
        private readonly LogementEntityFactory $entityFactory,
        private readonly LogementOutputFactory $outputFactory
    ) {}

    public function transformGetLogement(object $dataSourceResult): LogementOutputDto
    {
        $entity = $this->entityFactory->createLogementFromRaw($dataSourceResult);

        return $this->outputFactory->createGetLogement($entity);
    }

    public function transformListLogements(object $dataSourceResult): ListLogementsOuputDto
    {
        $logementsRaw = is_array($rawLogement = $dataSourceResult->ListeInfosLogements->infosLogement ?? null)
           ? $rawLogement : ($rawLogement ? [$rawLogement] : []);

        $entities = $this->entityFactory->createManyLogementsFromRawList($logementsRaw);

        return $this->outputFactory->createListLogements($entities);
    }
}
