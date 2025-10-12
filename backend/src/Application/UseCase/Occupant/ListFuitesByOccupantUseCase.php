<?php

declare(strict_types=1);

namespace App\Application\UseCase\Occupant;

use App\Application\Dto\Output\Shared\ListFuitesOuputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;

final class ListFuitesByOccupantUseCase
{
  public function __construct(
    private readonly OccupantDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(): ListFuitesOuputDto
  {
    return $this->serviceDataProvider->listFuitesByOccupantService();
  }
}
