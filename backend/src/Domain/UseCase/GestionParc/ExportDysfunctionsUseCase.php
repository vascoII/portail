<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ExportDysfunctionsInputDto;
use App\Application\Dto\Output\GestionParc\ExportDysfunctionsOutputDto;
use App\Domain\UseCase\UseCaseInterface;

final class ExportDysfunctionsUseCase implements UseCaseInterface
{
  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof ExportDysfunctionsInputDto);
    return new ExportDysfunctionsOutputDto(true);
  }
}
