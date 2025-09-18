<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Immeuble;

use App\Application\Dto\Input\Immeuble\ExportAnomaliesInputDto;
use App\Application\Dto\Output\Immeuble\ExportAnomaliesOutputDto;

use App\Domain\Service\Soap\ImmeubleSoapInterface;

final class ExportAnomaliesUseCase
{
  public function __construct(private readonly ImmeubleSoapInterface $service) {}

  public function execute(ExportAnomaliesInputDto $inputDto): ExportAnomaliesOutputDto
  {
    return $this->service->exportAnomaliesService($inputDto);
  }
}
