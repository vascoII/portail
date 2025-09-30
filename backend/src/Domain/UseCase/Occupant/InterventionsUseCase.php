<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\InterventionsInputDto;
use App\Application\Dto\Output\Occupant\InterventionsOutputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;

final class InterventionsUseCase
{
  public function __construct(
    private readonly OccupantDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(InterventionsInputDto $inputDto): InterventionsOutputDto
  {
    return $this->serviceDataProvider->listInterventionsService($inputDto);
  }
}
