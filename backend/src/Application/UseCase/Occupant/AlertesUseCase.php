<?php

declare(strict_types=1);

namespace App\Application\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\AlertesInputDto;
use App\Application\Dto\Output\Occupant\AlertesOutputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;

final class AlertesUseCase
{
  public function __construct(
    private readonly OccupantDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(AlertesInputDto $inputDto): AlertesOutputDto
  {
    return $this->serviceDataProvider->alertesService($inputDto);
  }
}
