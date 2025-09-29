<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ListLeaksInputDto;
use App\Application\Dto\Output\Occupant\ListLeaksOutputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;

final class ListLeaksUseCase
{
  public function __construct(
    private readonly OccupantDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(ListLeaksInputDto $inputDto): ListLeaksOutputDto
  {
    return $this->serviceDataProvider->listLeaksService($inputDto);
  }
}
