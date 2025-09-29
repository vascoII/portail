<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ExportDysfunctionsInputDto;
use App\Application\Dto\Output\Occupant\ExportDysfunctionsOutputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;

final class ExportDysfunctionsUseCase
{
  public function __construct(
    private readonly OccupantDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(ExportDysfunctionsInputDto $inputDto): ExportDysfunctionsOutputDto
  {
    return $this->serviceDataProvider->exportDysfunctionsService($inputDto);
  }
}
