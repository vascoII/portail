<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ExportAnomaliesInputDto;
use App\Application\Dto\Output\GestionParc\ExportAnomaliesOutputDto;
use App\Domain\UseCase\UseCaseInterface;

final class ExportAnomaliesUseCase implements UseCaseInterface
{
  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof ExportAnomaliesInputDto);
    return new ExportAnomaliesOutputDto(true);
  }
}
