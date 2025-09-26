<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\Dto\Input\Intervention\ReportInputDto;
use App\Application\Dto\Output\Intervention\ReportOutputDto;
use App\Domain\Service\DataProvider\InterventionInterface;

final class InterventionService implements InterventionInterface

  public function reportService(ReportInputDto $inputDto): ReportOutputDto
  {

  }
  
}
