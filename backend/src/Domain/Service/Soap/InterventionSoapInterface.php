<?php

declare(strict_types=1);

namespace App\Domain\Service\Soap;

use App\Application\Dto\Input\Intervention\ReportInputDto;
use App\Application\Dto\Output\Intervention\ReportOutputDto;

interface InterventionSoapInterface
{

  public function reportService(ReportInputDto $inputDto): ReportOutputDto;
}
