<?php

declare(strict_types=1);

namespace App\Domain\Service\Soap;

use App\Application\Dto\Input\Facture\IndexInputDto;
use App\Application\Dto\Output\Facture\IndexOutputDto;
use App\Application\Dto\Input\Facture\ReportInputDto;
use App\Application\Dto\Output\Facture\ReportOutputDto;

interface FactureSoapInterface
{

  public function indexService(IndexInputDto $inputDto): IndexOutputDto;
  public function reportService(ReportInputDto $inputDto): ReportOutputDto;
}
