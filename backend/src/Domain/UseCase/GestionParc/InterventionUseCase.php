<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\InterventionInputDto;
use App\Application\Dto\Output\GestionParc\InterventionOutputDto;
use App\Domain\UseCase\UseCaseInterface;

final class InterventionUseCase implements UseCaseInterface
{
  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof InterventionInputDto);
    return new InterventionOutputDto([]);
  }
}
