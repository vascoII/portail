<?php

declare(strict_types=1);

namespace App\Application\UseCase\Occupant;

use App\Application\Dto\Output\Occupant\GetOccupantOutputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;

final class GetOccupantUseCase
{
  public function __construct(
    private readonly OccupantDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(): GetOccupantOutputDto
  {
    return $this->serviceDataProvider->getOccupantService();
  }
}
