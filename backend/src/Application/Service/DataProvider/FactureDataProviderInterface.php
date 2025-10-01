<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Input\Shared\GetReportInputDto;
use App\Application\Dto\Output\Facture\ListFactureOutputDto;
use App\Application\Dto\Output\Facture\ReportFactureOutputDto;

interface FactureDataProviderInterface
{
  public function indexService(): ListFactureOutputDto;
  public function reportService(GetReportInputDto $inputDto): ReportFactureOutputDto;
}
