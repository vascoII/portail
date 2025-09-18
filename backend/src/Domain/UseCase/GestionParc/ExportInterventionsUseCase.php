<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ExportInterventionsInputDto;
use App\Application\Dto\Output\GestionParc\ExportInterventionsOutputDto;
use App\Domain\UseCase\UseCaseInterface;

final class ExportInterventionsUseCase implements UseCaseInterface
{
  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof ExportInterventionsInputDto);
    return new ExportInterventionsOutputDto(true);
  }
}
