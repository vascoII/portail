<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\LeaksInputDto;
use App\Application\Dto\Output\Occupant\LeaksOutputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;

final class LeaksUseCase
{
  public function __construct(
    private readonly OccupantDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(LeaksInputDto $inputDto): LeaksOutputDto
  {
    return $this->serviceDataProvider->listLeaksService($inputDto);
  }
}
