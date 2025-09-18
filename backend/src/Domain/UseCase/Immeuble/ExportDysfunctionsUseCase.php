<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\ExportDysfunctionsInputDto;
use App\Application\Dto\Output\Immeuble\ExportDysfunctionsOutputDto;

use App\Domain\Service\Soap\ImmeubleSoapInterface;

final class ExportDysfunctionsUseCase
{
  public function __construct(private readonly ImmeubleSoapInterface $service) {}

  public function execute(ExportDysfunctionsInputDto $inputDto): ExportDysfunctionsOutputDto
  {
    return $this->service->exportDysfunctionsService($inputDto);
  }
}
