<?php

declare(strict_types=1);

namespace App\Application\UseCase\Occupant;

use App\Application\Dto\Output\Shared\ListInterventionsOutputDto ;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;

final class ListInterventionsByOccupantUseCase
{
  public function __construct(
    private readonly OccupantDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(): ListInterventionsOutputDto 
  {
    return $this->serviceDataProvider->listInterventionsByOccupantService();
  }
}
