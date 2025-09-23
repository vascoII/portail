<?php

declare(strict_types=1);

namespace App\Domain\Service\Soap;

use App\Application\Dto\Input\Intervention\ReportInputDto;

interface InterventionSoapInterface
{

  public function reportService(ReportInputDto $inputDto): array;
}
