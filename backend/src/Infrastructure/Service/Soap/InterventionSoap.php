<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Soap;

use App\Application\Dto\Input\Intervention\ReportInputDto;
use App\Application\Dto\Output\Intervention\ReportOutputDto;
use App\Domain\Service\Soap\InterventionSoapInterface;

final class InterventionSoap implements InterventionSoapInterface
{
  public function reportService(ReportInputDto $inputDto): ReportOutputDto
  {
    // TODO: Implement reportService logic
    return new ReportOutputDto(true);
  }
}
