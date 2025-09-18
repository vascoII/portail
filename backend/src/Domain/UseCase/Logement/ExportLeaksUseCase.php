<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\ExportLeaksInputDto;
use App\Application\Dto\Output\Logement\ExportLeaksOutputDto;
use App\Domain\UseCase\UseCaseInterface;

final class ExportLeaksUseCase implements UseCaseInterface
{
  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof ExportLeaksInputDto);
    return new ExportLeaksOutputDto(true);
  }
}
