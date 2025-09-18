<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ListAnomaliesInputDto;
use App\Application\Dto\Output\Occupant\ListAnomaliesOutputDto;

use App\Domain\Service\Soap\OccupantSoapInterface;

final class ListAnomaliesUseCase
{
  public function __construct(private readonly OccupantSoapInterface $service) {}

  public function execute(ListAnomaliesInputDto $inputDto): ListAnomaliesOutputDto
  {
    \assert($inputDto instanceof ListAnomaliesInputDto);
    return new ListAnomaliesOutputDto([]);
  }
}
