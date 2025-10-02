<?php

declare(strict_types=1);

namespace App\Application\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\DysfunctionsInputDto;
use App\Application\Dto\Output\Occupant\DysfunctionsOutputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;

final class DysfunctionsUseCase
{
  public function __construct(
    private readonly OccupantDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(DysfunctionsInputDto $inputDto): DysfunctionsOutputDto
  {
    return $this->serviceDataProvider->listDysfunctionsService($inputDto);
  }
}
