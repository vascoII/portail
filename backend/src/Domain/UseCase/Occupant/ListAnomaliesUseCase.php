<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ListAnomaliesInputDto;
use App\Application\Dto\Output\Occupant\ListAnomaliesOutputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;

final class ListAnomaliesUseCase
{
  public function __construct(
    private readonly OccupantDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(ListAnomaliesInputDto $inputDto): ListAnomaliesOutputDto
  {
    return $this->serviceDataProvider->listAnomaliesService($inputDto);
  }
}
