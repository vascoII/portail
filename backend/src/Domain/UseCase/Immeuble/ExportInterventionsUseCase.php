<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\ExportInterventionsInputDto;
use App\Application\Dto\Output\Immeuble\ExportInterventionsOutputDto;
use App\Domain\UseCase\UseCaseInterface;

final class ExportInterventionsUseCase implements UseCaseInterface
{
  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof ExportInterventionsInputDto);
    return new ExportInterventionsOutputDto(true);
  }
}
