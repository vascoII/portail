<?php

declare(strict_types=1);

namespace App\Application\UseCase\Occupant;

use App\Application\Dto\Output\Shared\ListInternetionsOutputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;

final class ListInterventionsByOccupantUseCase
{
  public function __construct(
    private readonly OccupantDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(): ListInternetionsOutputDto
  {
    return $this->serviceDataProvider->listInterventionsByOccupantService();
  }
}
