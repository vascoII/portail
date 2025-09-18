<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\ExportDysfunctionsInputDto;
use App\Application\Dto\Output\Immeuble\ExportDysfunctionsOutputDto;
use App\Domain\UseCase\UseCaseInterface;

final class ExportDysfunctionsUseCase implements UseCaseInterface
{
  public function execute(object $inputDto): object
  {
    \assert($inputDto instanceof ExportDysfunctionsInputDto);
    return new ExportDysfunctionsOutputDto(true);
  }
}
