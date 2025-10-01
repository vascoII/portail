<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Intervention;

use App\Application\Dto\Input\Shared\GetReportInputDto;
use App\Application\Dto\Output\Intervention\ReportOutputDto;
use App\Application\Service\DataProvider\InterventionDataProviderInterface;

final class ReportUseCase
{
  public function __construct(
    private readonly InterventionDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(GetReportInputDto $inputDto): ReportOutputDto
  {
    return $this->serviceDataProvider->reportService($inputDto);
  }
}
