<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ExportAnomaliesInputDto;
use App\Application\Dto\Output\Occupant\ExportAnomaliesOutputDto;

use App\Domain\Service\Soap\OccupantSoapInterface;

final class ExportAnomaliesUseCase
{
  public function __construct(private readonly OccupantSoapInterface $service) {}

  public function execute(ExportAnomaliesInputDto $inputDto): ExportAnomaliesOutputDto
  {
    return $this->service->exportAnomaliesService($inputDto);
  }
}
