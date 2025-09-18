<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Soap;

use App\Application\Dto\Input\Facture\IndexInputDto;
use App\Application\Dto\Output\Facture\IndexOutputDto;
use App\Application\Dto\Input\Facture\ReportInputDto;
use App\Application\Dto\Output\Facture\ReportOutputDto;
use App\Domain\Service\Soap\FactureSoapInterface;

final class FactureSoap implements FactureSoapInterface
{
  public function indexService(IndexInputDto $inputDto): IndexOutputDto
  {
    // TODO: Implement indexService logic
    return new IndexOutputDto([]);
  }

  public function reportService(ReportInputDto $inputDto): ReportOutputDto
  {
    // TODO: Implement reportService logic
    return new ReportOutputDto(true);
  }
}
