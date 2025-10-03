<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Transformer;

use App\Application\Dto\Output\Intervention\ReportOutputDto;
use App\Application\Service\Transformer\InterventionTransformerInterface;
use App\Application\Factory\Intervention\InterventionEntityFactory;
use App\Application\Factory\Intervention\InterventionOutputFactory;

final class InterventionTransformer implements InterventionTransformerInterface
{
   public function __construct(
      private readonly InterventionEntityFactory $entityFactory,
      private readonly InterventionOutputFactory $outputFactory
   ) {}

   /**
    * Transform raw response to ReportInputDto
    */
   public function transformReport(object $dataSourceResult): ReportOutputDto
   {
      return new ReportOutputDto(
         data: $dataSourceResult,
         filename: "relevé-" . date('d-m-Y'),
         length: strlen($dataSourceResult)
      );
   }
}
