<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ExportAnomaliesInputDto;
use App\Application\Dto\Output\Occupant\ExportAnomaliesOutputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;

final class ExportAnomaliesUseCase
{
  public function __construct(
    private readonly OccupantDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(ExportAnomaliesInputDto $inputDto): ExportAnomaliesOutputDto
  {
    return $this->serviceDataProvider->exportAnomaliesService($inputDto);
  }
}
