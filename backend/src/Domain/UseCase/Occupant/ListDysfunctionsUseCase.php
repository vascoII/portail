<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ListDysfunctionsInputDto;
use App\Application\Dto\Output\Occupant\ListDysfunctionsOutputDto;
use App\Application\Service\DataProvider\OccupantDataProviderInterface;

final class ListDysfunctionsUseCase
{
  public function __construct(
    private readonly OccupantDataProviderInterface $serviceDataProvider
  ) {}

  public function execute(ListDysfunctionsInputDto $inputDto): ListDysfunctionsOutputDto
  {
    return $this->serviceDataProvider->listDysfunctionsService($inputDto);
  }
}
