<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\Dto\Output\Facture\IndexOutputDto;
use App\Application\Dto\Input\Facture\ReportInputDto;
use App\Application\Dto\Output\Facture\ReportOutputDto;

interface FactureInterface
{
  public function indexService(): IndexOutputDto;
  public function reportService(ReportInputDto $inputDto): ReportOutputDto;
}
