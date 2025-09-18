<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ExportLeaksInputDto;
use App\Application\Dto\Output\GestionParc\ExportLeaksOutputDto;
use App\Domain\UseCase\UseCaseInterface;

final class ExportLeaksUseCase implements UseCaseInterface
{
  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof ExportLeaksInputDto);
    return new ExportLeaksOutputDto(true);
  }
}
