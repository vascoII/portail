<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Occupant;

use App\Application\Dto\Input\Occupant\ShowInterventionInputDto;
use App\Application\Dto\Output\Occupant\ShowInterventionOutputDto;
use App\Domain\UseCase\UseCaseInterface;

final class ShowInterventionUseCase implements UseCaseInterface
{
  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof ShowInterventionInputDto);
    return new ShowInterventionOutputDto($inputDto->pkIntervention);
  }
}
