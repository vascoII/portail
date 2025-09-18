<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ShowInterventionInputDto;
use App\Application\Dto\Output\Occupant\ShowInterventionOutputDto;

use App\Domain\Service\Soap\OccupantSoapInterface;

final class ShowInterventionUseCase
{
  public function __construct(private readonly OccupantSoapInterface $service) {}

  public function execute(ShowInterventionInputDto $inputDto): ShowInterventionOutputDto
  {
    return $this->service->showInterventionService($inputDto);
  }
}
