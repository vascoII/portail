<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Input\Shared\GetReportInputDto;
use App\Application\Dto\Output\Shared\GetReportOutputDto;
use App\Application\Dto\Output\Facture\ListFacturesOutputDto;

interface FactureDataProviderInterface
{
  public function listFacturesService(): ListFacturesOutputDto;
  public function generateFacturePdfService(GetReportInputDto $inputDto): GetReportOutputDto;
}
