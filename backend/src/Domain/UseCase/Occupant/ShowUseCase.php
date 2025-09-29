<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ShowInputDto;
use App\Application\Dto\Output\Occupant\ShowOutputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;

final class ShowUseCase
{
  public function __construct(
    private readonly OccupantDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(ShowInputDto $inputDto): ShowOutputDto
  {
    return $this->serviceDataProvider->showService($inputDto);
  }
}
