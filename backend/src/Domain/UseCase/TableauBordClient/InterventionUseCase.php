<?php

declare(strict_types=1);

namespace App\Domain\UseCase\TableauBordClient;

use App\Application\Dto\Input\TableauBordClient\InterventionInputDto;
use App\Application\Dto\Output\TableauBordClient\InterventionOutputDto;
use App\Domain\UseCase\UseCaseInterface;

final class InterventionUseCase implements UseCaseInterface
{
  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof InterventionInputDto);
    return new InterventionOutputDto([]);
  }
}
