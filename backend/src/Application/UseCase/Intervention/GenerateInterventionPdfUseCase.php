<?php

declare(strict_types=1);

namespace App\Application\UseCase\Intervention;

use App\Application\Dto\Input\Shared\GetReportInputDto;
use App\Application\Dto\Output\Shared\GetReportOutputDto;
use App\Application\Service\DataProvider\InterventionDataProviderInterface;

final class GenerateInterventionPdfUseCase
{
  public function __construct(
    private readonly InterventionDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(GetReportInputDto $inputDto): GetReportOutputDto
  {
    return $this->serviceDataProvider->generateInterventionPdfService($inputDto);
  }
}
