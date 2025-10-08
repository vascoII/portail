<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Transformer;

use App\Application\Dto\Output\Shared\GetReportOutputDto;
use App\Application\Dto\Output\Facture\ListFacturesOutputDto;
use App\Application\Service\Transformer\FactureTransformerInterface;
use App\Application\Factory\Facture\FactureEntityFactory;
use App\Application\Factory\Facture\FactureOutputFactory;

final class FactureTransformer implements FactureTransformerInterface
{
  public function __construct(
    private readonly FactureEntityFactory $entityFactory,
    private readonly FactureOutputFactory $outputFactory
  ) {}

  /**
   * Transform raw response to IndexOutputDto
   */
  public function transformListFactures(object $dataSourceResult): ListFacturesOutputDto
  {
    $facturesRaw = $dataSourceResult->ListeFactures->facture ?? null;
    $entities = $this->entityFactory->createManyFromRawList($facturesRaw);

    return $this->outputFactory->create($entities);
  }

}
