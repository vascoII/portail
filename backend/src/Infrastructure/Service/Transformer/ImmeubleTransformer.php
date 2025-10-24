<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Transformer;

use App\Application\Dto\Output\Immeuble\GetImmeubleOutputDto;
use App\Application\Dto\Output\Immeuble\ListImmeublesOutputDto;
use App\Application\Factory\Immeuble\ImmeubleEntityFactory;
use App\Application\Factory\Immeuble\ImmeubleOutputFactory;
use App\Application\Service\Transformer\ImmeubleTransformerInterface;

final class ImmeubleTransformer implements ImmeubleTransformerInterface
{
    public function __construct(
        private readonly ImmeubleEntityFactory $entityFactory,
        private readonly ImmeubleOutputFactory $outputFactory
    ) {}

    public function transformGetImmeuble(object $dataSourceResult): GetImmeubleOutputDto
    {
        $entity = $this->entityFactory->createImmeubleFromRaw($dataSourceResult);

        return $this->outputFactory->createGetImmeuble($entity);
    }

    /**
     * Transform raw response to ListImmeublesOutputDto.
     */
    public function transformListImmeubles(object $dataSourceResult): ListImmeublesOutputDto
    {
        $immeublesRaw = is_array($rawImmeuble = $dataSourceResult->ListeInfosImmeubles->infosImmeuble ?? null)
           ? $rawImmeuble : ($rawImmeuble ? [$rawImmeuble] : []);

        $entities = $this->entityFactory->createManyImmeublesFromRawList($immeublesRaw);

        return $this->outputFactory->createListImmeubles($entities);
    }
}
