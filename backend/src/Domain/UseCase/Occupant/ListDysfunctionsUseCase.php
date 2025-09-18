<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ListDysfunctionsInputDto;
use App\Application\Dto\Output\Occupant\ListDysfunctionsOutputDto;

use App\Domain\Service\Soap\OccupantSoapInterface;

final class ListDysfunctionsUseCase
{
  public function __construct(private readonly OccupantSoapInterface $service) {}

  public function execute(ListDysfunctionsInputDto $inputDto): ListDysfunctionsOutputDto
  {
    return $this->service->listDysfunctionsService($inputDto);
  }
}
