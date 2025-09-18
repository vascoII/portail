<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ListInterventionsInputDto;
use App\Application\Dto\Output\Occupant\ListInterventionsOutputDto;

use App\Domain\Service\Soap\OccupantSoapInterface;

final class ListInterventionsUseCase
{
  public function __construct(private readonly OccupantSoapInterface $service) {}

  public function execute(ListInterventionsInputDto $inputDto): ListInterventionsOutputDto
  {
    \assert($inputDto instanceof ListInterventionsInputDto);
    return new ListInterventionsOutputDto([]);
  }
}
