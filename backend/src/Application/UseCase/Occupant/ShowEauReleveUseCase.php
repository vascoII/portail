<?php

declare(strict_types=1);

namespace App\Application\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ShowEauReleveInputDto;
use App\Application\Dto\Output\Occupant\ShowEauReleveOutputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;

final class ShowEauReleveUseCase
{
  public function __construct(
    private readonly OccupantDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(ShowEauReleveInputDto $inputDto): ShowEauReleveOutputDto
  {
    return $this->serviceDataProvider->showEauReleveService($inputDto);
  }
}
