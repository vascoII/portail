<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\ExportInterventionsInputDto;
use App\Application\Dto\Output\Immeuble\ExportInterventionsOutputDto;

use App\Domain\Service\Soap\ImmeubleSoapInterface;

final class ExportInterventionsUseCase
{
  public function __construct(private readonly ImmeubleSoapInterface $service) {}

  public function execute(ExportInterventionsInputDto $inputDto): ExportInterventionsOutputDto
  {
    \assert($inputDto instanceof ExportInterventionsInputDto);
    return new ExportInterventionsOutputDto(true);
  }
}
