<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ExportInterventionsInputDto;
use App\Application\Dto\Output\Occupant\ExportInterventionsOutputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;

final class ExportInterventionsUseCase
{
  public function __construct(
    private readonly OccupantDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(ExportInterventionsInputDto $inputDto): ExportInterventionsOutputDto
  {
    return $this->serviceDataProvider->exportInterventionsService($inputDto);
  }
}
