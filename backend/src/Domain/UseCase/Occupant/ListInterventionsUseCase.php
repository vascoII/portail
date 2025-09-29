<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ListInterventionsInputDto;
use App\Application\Dto\Output\Occupant\ListInterventionsOutputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;

final class ListInterventionsUseCase
{
  public function __construct(
    private readonly OccupantDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(ListInterventionsInputDto $inputDto): ListInterventionsOutputDto
  {
    return $this->serviceDataProvider->listInterventionsService($inputDto);
  }
}
