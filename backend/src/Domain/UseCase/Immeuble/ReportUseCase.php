<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\ReportInputDto;
use App\Application\Dto\Output\Immeuble\ReportOutputDto;

use App\Domain\Service\Soap\ImmeubleSoapInterface;

final class ReportUseCase
{
  public function __construct(private readonly ImmeubleSoapInterface $service) {}

  public function execute(ReportInputDto $inputDto): ReportOutputDto
  {
    return $this->service->reportService($inputDto);
  }
}
