<?php

declare(strict_types=1);

namespace App\Application\UseCase\Occupant;

use App\Application\Dto\Output\Shared\ListDysfonctionnementsOuputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;

final class ListDysfonctionnementsByOccupantUseCase
{
  public function __construct(
    private readonly OccupantDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(): ListDysfonctionnementsOuputDto
  {
    return $this->serviceDataProvider->listDysfonctionnementsByOccupantService();
  }
}
