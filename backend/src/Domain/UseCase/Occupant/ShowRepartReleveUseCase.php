<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ShowRepartReleveInputDto;
use App\Application\Dto\Output\Occupant\ShowRepartReleveOutputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;

final class ShowRepartReleveUseCase
{
  public function __construct(
    private readonly OccupantDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(ShowRepartReleveInputDto $inputDto): ShowRepartReleveOutputDto
  {
    return $this->serviceDataProvider->showRepartReleveService($inputDto);
  }
}
