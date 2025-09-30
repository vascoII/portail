<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\AnomaliesInputDto;
use App\Application\Dto\Output\Occupant\AnomaliesOutputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;

final class AnomaliesUseCase
{
  public function __construct(
    private readonly OccupantDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(AnomaliesInputDto $inputDto): AnomaliesOutputDto
  {
    return $this->serviceDataProvider->anomaliesService($inputDto);
  }
}
