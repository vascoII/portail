<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ShowInterventionInputDto;
use App\Application\Dto\Output\GestionParc\ShowInterventionOutputDto;
use App\Domain\UseCase\UseCaseInterface;

final class ShowInterventionUseCase implements UseCaseInterface
{
  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof ShowInterventionInputDto);
    return new ShowInterventionOutputDto($inputDto->pkImmeuble, $inputDto->pkIntervention);
  }
}
