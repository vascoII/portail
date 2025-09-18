<?php

declare(strict_types=1);

namespace App\Domain\UseCase\Logement;

use App\Application\Dto\Input\Logement\ExportAnomaliesInputDto;
use App\Application\Dto\Output\Logement\ExportAnomaliesOutputDto;

use App\Domain\Service\Soap\LogementSoapInterface;

final class ExportAnomaliesUseCase
{
  public function __construct(private readonly LogementSoapInterface $service) {}

  public function execute(ExportAnomaliesInputDto $inputDto): ExportAnomaliesOutputDto
  {
    return $this->service->exportAnomaliesService($inputDto);
  }
}
