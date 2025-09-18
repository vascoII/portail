<?php

declare(strict_types=1);

namespace App\Domain\UseCase\GestionParc;

use App\Application\Dto\Input\GestionParc\ExportAnomaliesInputDto;
use App\Application\Dto\Output\GestionParc\ExportAnomaliesOutputDto;

use App\Domain\Service\Soap\GestionParcSoapInterface;

final class ExportAnomaliesUseCase
{
  public function __construct(private readonly GestionParcSoapInterface $service) {}

  public function execute(ExportAnomaliesInputDto $inputDto): ExportAnomaliesOutputDto
  {
    return $this->service->exportAnomaliesService($inputDto);
  }
}
