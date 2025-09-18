<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ExportInterventionsInputDto;
use App\Application\Dto\Output\Occupant\ExportInterventionsOutputDto;

use App\Domain\Service\Soap\OccupantSoapInterface;

final class ExportInterventionsUseCase
{
  public function __construct(private readonly OccupantSoapInterface $service) {}

  public function execute(ExportInterventionsInputDto $inputDto): ExportInterventionsOutputDto
  {
    return $this->service->exportInterventionsService($inputDto);
  }
}
