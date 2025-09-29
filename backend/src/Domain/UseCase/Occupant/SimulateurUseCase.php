<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\SimulateurInputDto;
use App\Application\Dto\Output\Occupant\SimulateurOutputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;

final class SimulateurUseCase
{
  public function __construct(
    private readonly OccupantDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(SimulateurInputDto $inputDto): SimulateurOutputDto
  {
    return $this->serviceDataProvider->simulateurService($inputDto);
  }
}
