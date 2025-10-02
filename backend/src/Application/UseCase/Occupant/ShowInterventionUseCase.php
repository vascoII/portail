<?php

declare(strict_types=1);

namespace App\Application\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ShowInterventionInputDto;
use App\Application\Dto\Output\Occupant\ShowInterventionOutputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;

final class ShowInterventionUseCase
{
  public function __construct(
    private readonly OccupantDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(ShowInterventionInputDto $inputDto): ShowInterventionOutputDto
  {
    return $this->serviceDataProvider->showInterventionService($inputDto);
  }
}
