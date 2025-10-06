<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Transformer;

use App\Application\Dto\Output\Shared\GetReportOutputDto;
use App\Application\Dto\Output\Facture\GetFacturesOutputDto;
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
  public function transformIndex(object $dataSourceResult): GetFacturesOutputDto
  {
    $rawList = (array) $dataSourceResult;
    $facturesRaw = $rawList['facture'] ?? [];

    if (!is_array($facturesRaw)) {
      $facturesRaw = [$facturesRaw];
    }

    $entities = $this->entityFactory->createManyFromRawList($facturesRaw);

    return $this->outputFactory->create($entities);
  }

  /**
   * Transform raw response to ReportOutputDto
   */
  public function transformReport(object $dataSourceResult): GetReportOutputDto
  {
    $binary = (string) $dataSourceResult;
    $filename = 'releve-' . date('Y-m-d') . '.pdf';
    return new GetReportOutputDto(
      data: $binary,
      filename: $filename,
      length: strlen($binary)
    );
  }
}
